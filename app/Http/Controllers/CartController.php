<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class CartController extends Controller
{
    public function add_to_cart(Request $request, Product $product)
    {
        $request->validate([
            'amount' => 'required|gte:1'
        ]);

        $user_id = Auth::id();
        $product_id = $product->id;

        Cart::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'amount' => $request->amount
        ]);

        return Redirect::route('index_product');
    }
}
