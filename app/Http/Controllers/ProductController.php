<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::all();

        return view('products.index', ['products' => $products]);
    }

    public function create(): View
    {
        return view('products.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'sku' => 'required|unique:products,sku|max:100',
            'description' => 'nullable|string|max:500',                     //validating the data.
            'price' => 'required|numeric|min:0|decimal:0,2',
            'quantity' => 'required|integer|min:0',
        ]);
        $data['is_active'] = $request->boolean('is_active');

        Product::create($data);         //stores our data into database

        return redirect(route('products.index'))->with('success', 'Product Created Successfully.');  //after storing redirects to index page.
    }

    public function show(Product $product): View
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product): View
    {
        return view('products.edit', ['product' => $product]);
    }

    public function update(Product $product, Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'sku' => ['required', 'max:100', Rule::unique('products', 'sku')->ignore($product->id)],    //while updating the values the right unique values must remain same.
            'description' => 'nullable|string|max:500',             //validating the updated data.
            'price' => 'required|numeric|min:0|decimal:0,2',
            'quantity' => 'required|integer|min:0',
        ]);
        $data['is_active'] = $request->boolean('is_active');

        $product->update($data);

        return redirect(route('products.index'))->with('success', 'Product updated successfully');
    }

    public function delete(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect(route('products.index'))->with('success', 'Product deleted successfully');
    }
}