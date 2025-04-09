<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ShoppingCart; // Ensure you import the model
use App\Models\TblBooks; // Import the book model to fetch book details
use Illuminate\Support\Facades\Log;

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

        // Retrieve the selected items' data from the request
        $selectedItems = collect($request->input('selected_items'))->map(function ($id) use ($request) {
            // Retrieve the complete data for each selected item using the id
            return [
                'price' => $request->input("cart_data.$id.price"),
                'title' => $request->input("cart_data.$id.title"),
                'cover_image' => $request->input("cart_data.$id.cover_image"),
            ];
        });

        // Pass the selected items to the checkout view
        return view('user.checkout', compact('selectedItems'));
    }

    public function showPaymentForm()
    {
        // You don't need to pass the price again if you don't want it to show.
        return view('user.payment');
    }

    public function processPayment(Request $request)
    {
        // Validate the credit card details
        $validatedData = $request->validate([
            'card_number' => 'required|string|size:16',
            'expiry_date' => 'required|string|size:5',
            'cvv' => 'required|string|size:3',
            'cardholder_name' => 'required|string|max:255',
        ]);
    
        // Simulate payment processing
        // Redirect to success page
        return view('user.payment-success');
    }
}
