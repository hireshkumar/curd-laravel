<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Student;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        
        if (!session()->has('uid')) {
            session()->put('redirect_after_login', $productId);
            return redirect()->route('login');
        }

        $userId = session()->get('uid');
        $product = Product::find($productId);

        if (!$product) {
            return back()->with('error', 'Product not found.');
        }

       
        $cartItem = Cart::where('user_id', $userId)->where('product_id', $productId)->first();

        if ($cartItem) {
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }
        $cartCount = Cart::where('user_id', $userId)->sum('quantity');
        session()->put('cart_count', $cartCount);

        return redirect()->route('cart.page')->with('success', 'Product added to cart!');
    }

    public function viewCart()
    {
        if (!session()->has('uid')) {
            return redirect()->route('login')->with('error', 'Please login to view your cart.');
        }

        $userId = session()->get('uid');
        $cartItems = Cart::with('product')->where('user_id', $userId)->get();

        return view('cart', ['cartItems' => $cartItems]);
    }
    
   
    public function increaseQuantity($cartItemId)
    {
        $cartItem = Cart::with('product')->find($cartItemId);
        if ($cartItem) {
            $cartItem->quantity++;
            $cartItem->save();
            $cartCount = Cart::where('user_id', session()->get('uid'))->sum('quantity');
            session()->put('cart_count', $cartCount);
    
            return response()->json([
                'success' => true,
                'newQuantity' => $cartItem->quantity,
                'cartCount' => $cartCount,
                'unitPrice' => $cartItem->product->price,
                'totalPrice' => $cartItem->quantity * $cartItem->product->price,
            ]);
        }
        return response()->json(['success' => false], 400);
    }
    
    public function decreaseQuantity($cartItemId)
    {
        $cartItem = Cart::with('product')->find($cartItemId);
        if ($cartItem && $cartItem->quantity > 1) {
            $cartItem->quantity--;
            $cartItem->save();
            $cartCount = Cart::where('user_id', session()->get('uid'))->sum('quantity');
            session()->put('cart_count', $cartCount);
    
            return response()->json([
                'success' => true,
                'newQuantity' => $cartItem->quantity,
                'cartCount' => $cartCount,
                'unitPrice' => $cartItem->product->price,
                'totalPrice' => $cartItem->quantity * $cartItem->product->price,
            ]);
        }
        return response()->json(['success' => false], 400);
    }
    

      
    public function remove($id)
{
    $userId = session()->get('uid');
    $cartItem = Cart::find($id);

    if ($cartItem && $cartItem->user_id == $userId) {
        $cartItem->delete();

        $cartCount = Cart::where('user_id', $userId)->sum('quantity');
        session()->put('cart_count', $cartCount);

        return redirect()->back()->with('success', 'Item removed from cart.');
    }

    return redirect()->back()->with('error', 'item not found.');
}


    
}
