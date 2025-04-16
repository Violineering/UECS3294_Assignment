<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ShoppingCart; // Ensure you import the model
use App\Models\TblBooks; // Import the book model to fetch book details
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB; 

class CartController extends Controller
{
    public function cart()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Fetch cart items from the database instead of session
        $cartItems = ShoppingCart::where('user_id', Auth::id())
                    ->join('tbl_books', 'shopping_cart.book_id', '=', 'tbl_books.id')
                    ->select('shopping_cart.id', 'tbl_books.title', "tbl_books.cover_image", "price") // Adjust fields as needed
                    ->get();

        // Update the cart count in the session
        $cartCount = $cartItems->count();
        session(['cart_count' => $cartCount]);
    
        return view('user.cart', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'User not authenticated.'], 401);
        }

        $userId = Auth::id(); // Get user ID from session
        $bookId = $request->book_id;

        // Validate input
        $request->validate([
            'book_id' => 'required|exists:tbl_books,id', // Ensure book exists in tbl_books
        ]);

        // Check if the user already purchased the book
        $purchasedBook = DB::table('purchased_books')
                            ->where('user_id', $userId)
                            ->where('book_id', $bookId)
                            ->first();
        
        if ($purchasedBook) {
            return response()->json(['success' => false, 'message' => 'You already purchased this e-book.']);
        }
              
        // Check if the book is already in the user's cart
        $cartItem = ShoppingCart::where('user_id', $userId)
                                ->where('book_id', $bookId)
                                ->first();

        // If the book is already in the cart, return a message
        if ($cartItem) {
            return response()->json(['success' => false, 'message' => 'This e-book is already in your cart.']);
        }

        // Add new book to the cart in the database
        $cartItem = new ShoppingCart();
        $cartItem->user_id = $userId;
        $cartItem->book_id = $bookId;
        $cartItem->save();

        // Update the cart count in the session
        $cartCount = ShoppingCart::where('user_id', $userId)->count();
        session(['cart_count' => $cartCount]);

        return response()->json(['success' => true, 'message' => 'E-book added to cart successfully!']);
    }

    public function removeFromCart($id)
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Find the cart item by its ID and delete it
        $cartItem = ShoppingCart::where('id', $id)
                                ->where('user_id', Auth::id())
                                ->first();

        if ($cartItem) {
            $cartItem->delete();

            // Update the cart count in the session
            $cartCount = ShoppingCart::where('user_id', Auth::id())->count();
            session(['cart_count' => $cartCount]);

            return redirect()->route('cart')->with('success', 'Book removed from cart!');
        }

        return redirect()->route('cart')->with('error', 'Cart item not found.');
    }

    public function checkout(Request $request)
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Validate that selected_items is an array
        $request->validate([
            'selected_items' => 'required|array',
        ]);

        // Get the selected items from the request
        $selectedItems = $request->input('selected_items');

        // Get existing items in the session
        $existingCheckoutItems = session('checkout_items', collect());

        // Remove any items from the session that are unchecked
        $existingCheckoutItems = $existingCheckoutItems->filter(function ($item) use ($selectedItems) {
            return in_array($item['title'], $selectedItems);  // Keep only items that are checked
        });

        // Map through the selected items and push them to the session
        $checkoutItems = collect($selectedItems)->map(function ($id) use ($request) {
            return [
                'title' => $request->input("cart_data.$id.title"),
                'price' => $request->input("cart_data.$id.price"),
                'cover_image' => $request->input("cart_data.$id.cover_image"),
            ];
        });

        // Merge the new items into the existing session data, ensuring no duplicates
        $existingCheckoutItems = $existingCheckoutItems->merge($checkoutItems);

        // Store the updated items back in the session
        session(['checkout_items' => $existingCheckoutItems]);

        return view('user.checkout');
    }

    public function processPayment(Request $request)
    {
        // Validate credit card input
        $validatedData = $request->validate([
            'card_number' => 'required|string|size:16',
            'expiry_month' => [
                'required',
                'integer',
                'min:1',
                'max:12',
                function ($attribute, $value, $fail) {
                    if ($value < 1 || $value > 12) {
                        return $fail('The month must be between 1 and 12.');
                    }
                },
            ],
            'expiry_year' => [
                'required',
                'integer',
                'min:00', // Allow 2 digit years
                'max:99', // Allow 2 digit years (e.g., 2025 -> 25)
                function ($attribute, $value, $fail) {
                    $currentYear = (int) date('y');
                    $currentMonth = (int) date('m');
                    $expiryYear = (int) $value;
        
                    if ($expiryYear < $currentYear) {
                        return $fail('The year must be a future year.');
                    }
        
                    // If expiry year is the current year, check if the month has passed
                    if ($expiryYear === $currentYear && $value < $currentMonth) {
                        return $fail('The expiry month must be a future month.');
                    }
                },
            ],
            'cvv' => 'required|string|size:3',
            'cardholder_name' => 'required|string|max:50',
        ]);

        // Get the checkout items from session
        $checkoutItems = session('checkout_items');

        if (!$checkoutItems || $checkoutItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'No items in checkout.');
        }

        // 3. Insert each purchased item into purchased_books table and delete from shopping_cart table
        foreach ($checkoutItems as $item) {
            // Get the book record by title (or better: use book_id if available)
            $book = DB::table('tbl_books')->where('title', $item['title'])->first();

            if ($book) {
                // Insert into purchased_books table
                DB::table('purchased_books')->insert([
                    'user_id' => Auth::id(),
                    'book_id' => $book->id,
                    'title' => $book->title,
                    'cover_image' => $book->cover_image,
                    'pdf_file' => $book->pdf_file,
                    'purchased_datetime' => now()
                ]);

                // Delete from shopping_cart table
                DB::table('shopping_cart')
                    ->where('user_id', Auth::id())
                    ->where('book_id', $book->id)  // Use the book_id from the book record
                    ->delete();
            }
        }

        // 4. Clear checkout session
        session()->forget('checkout_items');

        // 5. Redirect to payment success page
        return view('user.payment-success');
    }
}
