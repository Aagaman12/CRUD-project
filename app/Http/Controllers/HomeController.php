<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Category::orderBy('name')->get();

        $products = Product::with('category')
            ->where('is_active', true)
            ->latest()
            ->take(8)
            ->get();

        return view('public.dashboard.landing', compact('products', 'categories'));
    }
}
