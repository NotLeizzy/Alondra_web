<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $query = Products::query();

        // SEARCH FUNCTION
        if ($request->search) {
            $query->where('products_name', 'like', '%' . $request->search . '%');
        }

        $products = $query->get();

        return view('products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'products_name' => 'required',
            'unit_code' => 'required',
            'color' => 'required',
            'cost_price' => 'required|numeric'
        ]);

        Products::create($validated);

        return redirect()->back()->with('success', 'Product added successfully!');
    }

    public function show(Products $product)
    {
        return $product;
    }

    public function update(Request $request, Products $product)
    {
        $validated = $request->validate([
            'products_name' => 'required',
            'unit_code' => 'required',
            'color' => 'required',
            'cost_price' => 'required|numeric'
        ]);

        $product->update($validated);

        return redirect()->back()->with('success', 'Product updated successfully!');
    }

    public function destroy(Products $product)
    {
        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully!');
    }
}