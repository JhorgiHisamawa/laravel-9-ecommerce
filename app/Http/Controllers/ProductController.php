<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function create_product()
    {
        return view('create_product');
    }

    public function store_product(Request $request)
    {
            $request->validate([
                'name' => 'required',
                'price' => 'required',
                'stock' => 'required',
                'description' => 'required',
                'image_url' => 'required'
            ]);

            // Store 
            $file = $request->file('image_url');
            $path = $file->store('public/products');

            Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'stock' => $request->stock,
                'description' => $request->description,
                'image_url' => str_replace('public/', '', $path), // Store with a name file
            ]);


            return Redirect::route('index_product');

    }

    public function index_product()
    {
        $products = Product::all();
        return view('index_product', compact('products'));
    }

    public function show_product(Product $product)
    {
        return view('show_product', compact('product'));
    }
}
