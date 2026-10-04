@extends('layouts.app')
@section('title', 'Index Page')

@section('content')
    <div class="max-w-7xl mx-auto px-margin py-space-lg">
        <div class="flex flex-col w-full">

            <div class="flex flex-col md:flex-row md:items-end justify-between gap-space-md mb-space-lg">
                <div>
                    <div class="flex items-center gap-space-xs mb-1">
                        <span class="w-2 h-2 rounded-full bg-primary-container"></span>
                        <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Inventory
                            System</span>
                    </div>
                    <h1 class="font-display-lg text-display-lg text-on-surface tracking-tight">Product Index</h1>
                </div>
                
                <a href="{{ route('products.create') }}"
                    class="inline-flex items-center justify-center gap-space-xs bg-primary-container text-on-primary px-space-lg py-space-sm rounded-lg font-label-lg text-label-lg shadow-sm hover:bg-secondary transition-all active:scale-[0.98]">
                    <span class="material-symbols-outlined text-lg">add</span>
                    <span>CREATE A PRODUCT</span>
                </a>
               
            </div>

            @if(session()->has('success'))
                <div
                    class="mb-space-md px-space-md py-space-sm rounded-lg bg-primary-container/10 text-primary-container font-label-md text-label-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm mb-space-md">
                <form method="get" action="{{ route('products.index') }}"
                    class="flex flex-wrap lg:flex-nowrap items-center gap-space-sm">

                    <div class="relative flex-1 min-w-[240px]">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-base select-none">search</span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search for product."
                            class="w-full bg-surface-container-low pl-9 pr-space-md py-space-sm rounded-lg font-body-md text-body-md text-on-surface placeholder:text-on-surface-variant focus:outline-none focus:bg-surface-container-lowest transition-colors" />
                    </div>
                    <div class="flex items-center gap-space-xs min-w-[130px]">
                        <div class="relative w-full">
                            <select name="category"
                                class="w-full appearance-none bg-surface-container-low px-space-md py-space-sm pr-8 rounded-lg font-label-md text-label-md text-on-surface focus:outline-none focus:bg-surface-container-lowest cursor-pointer">
                                <option value="" @selected(!request('category'))>All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected((string) request('category') === (string) $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center gap-space-xs min-w-[130px]">
                        <div class="relative w-full">
                            <select name="sort"
                                class="w-full appearance-none bg-surface-container-low px-space-md py-space-sm pr-8 rounded-lg font-label-md text-label-md text-on-surface focus:outline-none focus:bg-surface-container-lowest cursor-pointer">
                                <option value="sort" @selected(!request('sort'))>Sort By</option>
                                <option value="name" @selected(request('sort') === 'name')>Name</option>
                                <option value="price" @selected(request('sort') === 'price')>Price</option>
                                <option value="quantity" @selected(request('sort') === 'quantity')>Quantity</option>
                                <option value="created_at" @selected(request('sort') === 'created_at')>New</option>
                            </select>
                            <span
                                class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-on-surface-variant text-base pointer-events-none">expand_more</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-space-xs min-w-[130px]">
                        <div class="relative w-full">
                            <select name="direction"
                                class="w-full appearance-none bg-surface-container-low px-space-md py-space-sm pr-8 rounded-lg font-label-md text-label-md text-on-surface focus:outline-none focus:bg-surface-container-lowest cursor-pointer">
                                <option value="asc" @selected(request('direction') === 'asc')>Ascending</option>
                                <option value="desc" @selected(request('direction') === 'desc')>Descending</option>
                            </select>
                            <span
                                class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-on-surface-variant text-base pointer-events-none">expand_more</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-space-xs min-w-[120px]">
                        <div class="relative w-full">
                            <select name="status"
                                class="w-full appearance-none bg-surface-container-low px-space-md py-space-sm pr-8 rounded-lg font-label-md text-label-md text-on-surface focus:outline-none focus:bg-surface-container-lowest cursor-pointer">
                                <option value="" @selected(!request('status'))>All Statuses</option>
                                <option value="active" @selected(request('status') === 'active')>Active</option>
                                <option value="inactive" @selected(request('status') === 'inactive')>Inactive</option>
                            </select>
                            <span
                                class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-on-surface-variant text-base pointer-events-none">expand_more</span>
                        </div>
                    </div>

                    <button type="submit"
                        class="px-space-lg py-space-sm rounded-lg bg-primary-container text-on-primary font-label-md text-label-md hover:bg-secondary transition-colors cursor-pointer">
                        Apply
                    </button>
                </form>
            </div>

            <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden mb-space-md">
                <div class="overflow-x-auto">
                    <table class="w-full text-left font-body-md text-body-md">
                        <thead>
                            <tr
                                class="bg-surface-container-low text-on-surface-variant font-label-sm text-label-sm uppercase tracking-wider">
                                <th class="py-space-md px-space-md">Id</th>
                                <th class="py-space-md px-space-md">Image</th>
                                <th class="py-space-md px-space-md">Name</th>
                                <th class="py-space-md px-space-md">Sku</th>
                                <th class="py-space-md px-space-md min-w-[280px]">Description</th>
                                <th class="py-space-md px-space-md text-right">Price</th>
                                <th class="py-space-md px-space-md text-right">Quantity</th>
                                <th class="py-space-md px-space-md">Category</th>
                                <th class="py-space-md px-space-md text-center">Active Status</th>
                                <th class="py-space-md px-space-md text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-on-surface divide-y divide-surface-variant/20">
                            @forelse ($products as $product)
                                <tr class="hover:bg-surface-container-low transition-colors">
                                    <td
                                        class="py-space-sm px-space-md font-label-md text-label-md font-medium text-on-surface-variant">
                                        {{ $product->id }}
                                    </td>
                                    <td class="py-space-sm px-space-md">
                                        <div
                                            class="w-12 h-12 rounded-lg bg-surface-container-high overflow-hidden shadow-sm flex items-center justify-center">
                                            @if($product->image)
                                                <img class="w-full h-full object-cover"
                                                    src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                            @endif
                                        </div>
                                    </td>
                                    <td class="py-space-sm px-space-md font-medium text-on-surface whitespace-nowrap">
                                        {{ $product->name }}
                                    </td>
                                    <td
                                        class="py-space-sm px-space-md font-label-sm text-label-sm font-semibold tracking-wide text-on-surface-variant whitespace-nowrap">
                                        {{ $product->sku }}
                                    </td>
                                    <td class="py-space-sm px-space-md text-on-surface-variant max-w-[220px]">
                                        <p class="line-clamp-2">{{ $product->description }}</p>
                                    </td>
                                    <td class="py-space-sm px-space-md text-right font-medium whitespace-nowrap">
                                        {{ $product->price }}
                                    </td>
                                    <td class="py-space-sm px-space-md text-right font-medium whitespace-nowrap">
                                        {{ $product->quantity }}
                                    </td>

                                    <td class="py-space-sm px-space-md text-on-surface-variant whitespace-nowrap">
                                        {{ $product->category->name ?? '—' }}
                                    </td>

                                    <td class="py-space-sm px-space-md text-center whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-space-sm py-0.5 rounded-full text-xs font-medium {{ $product->is_active ? 'bg-surface-container-high text-on-surface' : 'bg-error-container/60 text-error' }}">
                                            {{ $product->is_active ? 'Yes' : 'No' }}
                                        </span>
                                    </td>
                                    <td class="py-space-sm px-space-md text-center whitespace-nowrap">
                                        <div class="inline-flex items-center gap-space-xs font-label-sm text-label-sm">
                                            <a href="{{ route('products.show', $product) }}"
                                                class="text-tertiary hover:underline px-1 py-0.5">Show</a>
                                                @can('update', $product)
                                            <span class="text-surface-container-highest">/</span>
                                            <a href="{{ route('products.edit', $product) }}"
                                                class="text-on-surface-variant hover:text-on-surface px-1 py-0.5">Edit</a>
                                                @endcan
                                                @can('delete', $product)
                                            <span class="text-surface-container-highest">/</span>
                                            <form method="post" action="{{ route('products.delete', $product) }}" 
                                                class="inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"
                                                    class="text-primary-container hover:text-red-600 px-1 py-0.5 cursor-pointer">Delete</button>
                                            </form>
                                            @endcan
                                            
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="py-12 text-center text-on-surface-variant">
                                        No products match the current search.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-between gap-space-md pt-space-xs px-1">
                <p class="font-body-md text-body-md text-on-surface-variant">
                    Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of
                    {{ $products->total() }} results
                </p>
                <div>
                    {{ $products->links() }}
                </div>
            </div>

        </div>
    </div>
@endsection