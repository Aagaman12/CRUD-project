<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $categoryId = $request->query('category');

        $products = Product::query()
            ->with('category')
            ->where('is_active', true) // public site: only active products, always
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('sku', 'like', "%{$search}%");
                });
            })
            ->when($categoryId, fn ($query) => $query->where('category_id', $categoryId))

            ->paginate(12)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('public.shop', compact('products', 'categories'));
    }

    public function show(Product $product): View
    {
        abort_unless($product->is_active, 404);

        return view('public.show', compact('product'));
    }
}
