<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ShoppingCart; // Ensure you import the model
use App\Models\TblBooks; // Import the book model to fetch book details

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
                    ->select('shopping_cart.id', 'tbl_books.title', "tbl_books.cover_image") // Adjust fields as needed
                    ->get();

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

        // Add new book to the cart
        $cartItem = new ShoppingCart();
        $cartItem->user_id = $userId;
        $cartItem->book_id = $bookId;
        $cartItem->save();

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
        return redirect()->route('cart')->with('success', 'Book removed from cart!');
    }

    return redirect()->route('cart')->with('error', 'Cart item not found.');
}
}
