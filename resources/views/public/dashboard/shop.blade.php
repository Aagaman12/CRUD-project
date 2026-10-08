@extends('layouts.public')

@section('title', 'Shop - ' . config('app.name'))

@section('content')
    <section class="w-full py-12 lg:py-16 bg-surface">
        <div class="max-w-[1360px] mx-auto px-5 md:px-margin">

            <div class="flex flex-col md:flex-row md:items-end justify-between gap-space-md mb-space-lg">
                <div>
                    <div class="flex items-center gap-space-xs mb-1">
                        <span class="w-2 h-2 rounded-full bg-primary-container"></span>
                        <span class="font-label-sm text-label-sm uppercase tracking-wider text-secondary">Catalog
                            </span>
                    </div>
                    <h1 class="font-display-lg text-display-lg text-on-surface tracking-tight">Shop For Products</h1>
                </div>
                
                <a href="{{ route('products.create') }}"
                    class="inline-flex items-center justify-center gap-space-xs bg-primary-container text-on-primary px-space-lg py-space-sm rounded-lg font-label-lg text-label-lg shadow-sm hover:bg-secondary transition-all active:scale-[0.98]">
                    <span class="material-symbols-outlined text-lg">add</span>
                    <span>Become a Seller</span>
                </a>
               
            </div>

            {{-- Filters --}}
            <form method="get" action="{{ route('public.dashboard.shop') }}"
                class="sticky top-20 z-40 bg-surface-container-lowest p-space-md rounded-xl shadow-md mb-space-lg flex flex-wrap lg:flex-nowrap items-center gap-space-sm">

                <div class="relative flex-1 min-w-[220px]">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-base select-none">search</span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search a Product..."
                        class="w-full bg-surface-container-low pl-9 pr-space-md py-space-sm rounded-lg font-body-md text-body-md text-on-surface placeholder:text-on-surface-variant focus:outline-none focus:bg-surface-container-lowest transition-colors">
                </div>
                
                       
                    
                <select name="category"
                    class="min-w-[160px] bg-surface-container-low px-space-md py-space-sm rounded-lg font-label-md text-label-md text-on-surface focus:outline-none cursor-pointer">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected((string) request('category') === (string) $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                

                <button type="submit"
                    class="px-space-lg py-space-sm rounded-lg bg-primary-container text-on-primary font-label-md text-label-md hover:bg-secondary transition-colors cursor-pointer">
                    Apply
                </button>

                @if (request()->hasAny(['search', 'category', 'sort']))
                    <a href="{{ route('public.dashboard.shop') }}"
                        class="px-space-md py-space-sm font-label-md text-label-md text-on-surface-variant hover:text-on-surface transition-colors">
                        Reset
                    </a>
                @endif
            </form>

            <p class="text-sm text-on-surface-variant mb-space-md">
                Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() }}
                products
            </p>

            {{-- Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-space-lg">
                @forelse ($products as $product)
                    @include('public.partials.product-card', ['product' => $product])
                @empty
                    <p class="col-span-full text-center text-on-surface-variant py-16">
                        No products match your search.
                    </p>
                @endforelse
            </div>

            <div class="mt-space-xl">
                {{ $products->links() }}
            </div>
        </div>
    </section>
@endsection