<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ShopController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): View
    {
        $products = Product::query()
            ->with('category')
            ->where('is_active', true)
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('public.dashboard.shop', compact('products', 'categories'));
    }

    public function show(Product $product): View
    {
        abort_unless($product->is_active, 404);

        return view('public.dashboard.show', compact('product'));
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

        return redirect(route('public.dashboard.shop'))->with('success', 'Product Uploaded Successfully.');  // after storing redirects to index page.
    }

    public function search(Request $request): View        // logic of searching products, sorting and pagination.
    {
        $search = $request->query('search');

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
            ->where('is_active', true)
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('sku', 'like', "%{$search}%");
                });
            })

            ->when($categoryId, fn ($query) => $query->where('category_id', $categoryId))
            ->orderBy($sort, $direction)
            ->paginate(12)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('public.dashboard.shop', compact('products', 'categories'));
    }

    public function edit(Product $product): View
    {
        $this->authorize('update', $product);
        $categories = Category::orderBy('name')->get();

        return view('public.dashboard.edit', compact('product', 'categories'));
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

        return redirect(route('public.dashboard.shop'))->with('success', 'Product updated successfully');
    }

    public function delete(Product $product): RedirectResponse
    {
        $this->authorize('delete', $product);
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect(route('public.dashboard.shop'))->with('success', 'Product deleted successfully');
    }

    public function addToCart(Request $request): RedirectResponse
    {
        $existingCart = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($existingCart) {
            return redirect()->back()->with('error', 'Product is already in your cart.');
        }

        $cart = new Cart;
        $cart->user_id = Auth::user()->id;
        $cart->product_id = $request->product_id;
        $cart->save();

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }

    public function cart(): View
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();

        $items = $cartItems->map(function ($item) {
            $product = Product::find($item->product_id);

            return [
                'product' => $product,
                'subtotal' => $product->price,
            ];
        });

        $total = $items->sum('subtotal');

        return view('public.dashboard.cart', compact('items', 'total'));
    }

    public function removeFromCart(Product $product): RedirectResponse
    {
        Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->delete();

        return redirect()->back()->with(
            'success',
            'Product removed from cart.'
        );
    }
}
