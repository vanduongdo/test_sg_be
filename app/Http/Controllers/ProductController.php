<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return $products;
    }

    public function show(Request $request)
    {
        $product = Product::findOrFail($request->id);
        return $product;
    }

    public function store(Request $request)
    {
        $request->validate([
            'group_ID' => 'required',
            'name' => 'required',
            'description' => 'required'
        ]);
        $product = new Product;
        $product->group_ID = $request->group_ID;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->save();

        return response()->json(['message' => 'Product created successfully', 'product' => $product], 201);
    }

    public function update(Request $request)
    {
        $request->validate([
            'group_ID' => 'required',
            'name' => 'required',
            'description' => 'required'
        ]);
        $product = Product::findOrFail($request->id);

        $product->group_ID = $request->group_ID;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->update();

        return response()->json(['message' => 'Product edit successfully', 'product' => $product], 200);
    }

    public function destroy(Request $request)
    {
       Product::findOrFail($request->id)->delete();

        return response()->json(['message' => 'Product deleted'], 200);
    }
}
