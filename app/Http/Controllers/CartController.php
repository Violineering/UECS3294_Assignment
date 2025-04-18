<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ShoppingCart; 
use App\Models\PurchasedBooks;
use App\Models\TblBooks; 
use App\Models\Book; 
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB; 

class CartController extends Controller
{
    public function cart()
    {
        // Fetch cart items from the database 
        $cartItems = ShoppingCart::where('user_id', Auth::id())
            ->with('book') 
            ->get();

        // Update the cart count in the session
        $cartCount = $cartItems->count();
        session(['cart_count' => $cartCount]);

        return view('user.cart', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
        // Get the authenticated user's ID
        $userId = Auth::id(); 
        $bookId = $request->book_id;

        // Validate input
        $request->validate([
            'book_id' => 'required|exists:tbl_books,id',
        ]);

        // Check if the user already purchased the book
        $purchasedBook = Auth::user()->purchasedBooks()
                             ->where('book_id', $bookId)
                             ->first();
        
        if ($purchasedBook) {
            return response()->json(['success' => false, 'message' => 'You already purchased this e-book.']);
        }
              
        // Check if the book is already in the user's cart
        $cartItem = ShoppingCart::where('user_id', $userId)
                                ->where('book_id', $bookId)
                                ->first();

        if ($cartItem) {
            return response()->json(['success' => false, 'message' => 'This e-book is already in your cart.']);
        }

        // Add new book to the cart in the cart table in database
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
        // Validate selected_items input
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

        // Merge the new items into the existing session data to ensure no duplicates
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
                function ($attribute, $value, $fail) use ($request) {
                    if ($value < 1 || $value > 12) {
                        return $fail('The month must be between 1 and 12.');
                    }
                },
            ],
            'expiry_year' => [
                'required',
                'integer',
                'min:00', 
                'max:99',
                function ($attribute, $value, $fail) use ($request) {
                    $currentYear = (int) date('y'); 
                    $currentMonth = (int) date('m'); 
                    $expiryYear = (int) $value;
        
                    if ($expiryYear < $currentYear) {
                        return $fail('The card is expired.');
                    }

                    if ($expiryYear === $currentYear && (int)$request->expiry_month < $currentMonth) {
                        return $fail('The card is expired.');
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

        // Insert each purchased item into purchased_books table and delete from shopping_cart table
        foreach ($checkoutItems as $item) {
            $book = Book::where('title', $item['title'])->first();
        
            if ($book) {
                Auth::user()->purchasedBooks()->create([
                    'book_id' => $book->id,
                    'title' => $book->title,
                    'cover_image' => $book->cover_image,
                    'pdf_file' => $book->pdf_file,
                    'purchased_datetime' => now(),
                ]);
        
                Auth::user()->cartItems()->where('book_id', $book->id)->delete();
            }
        }

        // Clear sessions
        session()->forget('checkout_items');
        session()->forget('cart_count');

        return view('user.payment-success');
    }
}
