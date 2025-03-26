<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class CartController extends Controller
{
    public function  __construct()
    {
        $this->middleware('auth');
    }

    public function add_to_cart(Request $request, Product $product)
    {
        
        $user_id = Auth::id();
        $product_id = $product->id;


        // Check if the product already exists in the cart
        $existing_cart = Cart::where('product_id', $product_id)->where('user_id', $user_id)->first();
        
        if ($existing_cart == null) {
            $request->validate([
                'amount' => 'required|gte:1|lte:' . $product->stock 
            ]);
    
    
            Cart::create([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'amount' => $request->amount
            ]);
        } 
        else 
        {
            // Update the existing cart with the new amount
            // if the new amount is greater than the stock of the product 
            $request->validate([
                'amount' => 'required|gte:1|lte:' . ($product->stock - $existing_cart->amount)
            ]);
    
            $existing_cart->update([
                'amount' => $existing_cart->amount + $request->amount
            ]);
        }
       

        return Redirect::route('index_product');
    }

    public function show_cart()
    {
        $user_id = Auth::id();
        $carts = Cart::where('user_id', $user_id)->get();

        return view('show_cart', compact('carts'));
    }

    public function update_cart(Request $request, Cart $cart)
    {
        $request->validate([
            'amount' => 'required|gte:1|lte:'. $cart->product->stock
        ]);

        $cart->update([
            'amount' => $request->amount
        ]);

        return Redirect::route('show_cart');
    }

    public function delete_cart(Cart $cart)
    {
        $cart->delete();
        return Redirect::back();
    }
}
