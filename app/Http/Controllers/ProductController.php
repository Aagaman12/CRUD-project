<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Validation\Rule;  

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', ['products' => $products]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',                               //validating our data.
            'sku' => 'required|unique:products,sku|max:100',
            'description' => 'nullable|string|max:500',
            'price' => 'required|min:0|decimal:0,2',
            'quantity' => 'required|numeric|min:0',

        ]);
        $data['is_active'] = $request->boolean('is_active');

        $newProduct = Product::create($data);   //stores our data into database
        return redirect(route('products.index'))->with('success', 'Product Created Successfully.');  //after storing redirects to index page.

    }

    public function show(Product $product){
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {                                                       
        return view('products.edit', ['product' => $product]);

    }

    public function update(Product $product, Request $request)
    {
        $data = $request->validate([                        //validating our updated data.
            'name' => 'required|string|max:100',                                
            'sku' => ['required|max:100', Rule::unique('products', 'sku')->ignore($product->id),],   //while updating the values the right unique values must remain same.
            'description' => 'nullable|string|max:500',
            'price' => 'required|min:0|decimal:0,2',
            'quantity' => 'required|numeric|min:0',

        ]);
        $data['is_active'] = $request->boolean('is_active');

        $product->update($data);
        return redirect(route('products.index'))->with('success', 'Product updated successfully');
    }

    public function delete(Product $product, Request $Request){
        $product->delete();
        return redirect(route('products.index'))->with('success', 'Product deleted successfully');
    }

    



}
