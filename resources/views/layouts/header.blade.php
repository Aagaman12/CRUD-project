<nav>
    @unless(request()->routeIs('products.index') || request()->routeIs('products.create'))
    <a href="{{ route('products.index') }}">Products</a>
    <a href="{{ route('products.create') }}">Create a Product</a>
    @endunless
</nav>