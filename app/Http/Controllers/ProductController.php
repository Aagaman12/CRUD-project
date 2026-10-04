<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductController extends Controller
{
    use AuthorizesRequests;

    // Task 1

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('products.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'image' => 'nullable|image|max:2048',
            'name' => 'required|string|max:100',
            'sku' => 'required|unique:products,sku|max:100',
            'description' => 'nullable|string|max:500',                                             // validating the data.
            'price' => 'required|numeric|min:0|decimal:0,2',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');

        $data['user_id'] = auth()->id();

        Product::create($data);         // stores our data into database.

        return redirect(route('products.index'))->with('success', 'Product Created Successfully.');  // after storing redirects to index page.
    }

    public function show(Product $product): View
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product): View
    {
        $this->authorize('update', $product);
        $categories = Category::orderBy('name')->get();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Product $product, Request $request): RedirectResponse
    {
        $this->authorize('update', $product);
        $data = $request->validate([
            'image' => 'nullable|image|max:2048',
            'name' => 'required|string|max:100',
            'sku' => ['required', 'max:100', Rule::unique('products', 'sku')->ignore($product->id)],    // lets unique values remain same.
            'description' => 'nullable|string|max:500',                                                 // validating the updated data.
            'price' => 'required|numeric|min:0|decimal:0,2',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');

        $product->update($data);

        return redirect(route('products.index'))->with('success', 'Product updated successfully');
    }

    public function delete(Product $product): RedirectResponse
    {
        $this->authorize('delete', $product);
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect(route('products.index'))->with('success', 'Product deleted successfully');
    }

    // Task 2

    public function search(Request $request): View        // logic of searching products, sorting and pagination.
    {
        $search = $request->query('search');
        $status = $request->query('status');
        $categoryId = $request->query('category');

        $allowedSorts = ['name', 'price', 'quantity', 'created_at'];
        $sort = $request->query('sort');

        if (! in_array($sort, $allowedSorts, true)) {
            $sort = 'name';
        }

        $direction = match ($request->query('direction')) {
            'desc' => 'desc',
            default => 'asc',
        };

        $products = Product::query()
            ->with('category')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('sku', 'like', "%{$search}%");
                });
            })
            ->when($status === 'active', fn ($query) => $query->where('is_active', true))
            ->when($status === 'inactive', fn ($query) => $query->where('is_active', false))
            ->when($categoryId, fn ($query) => $query->where('category_id', $categoryId))
            ->orderBy($sort, $direction)
            ->paginate(10)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('products.index', compact('products', 'categories'));
    }
}
