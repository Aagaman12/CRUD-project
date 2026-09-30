@extends('layouts.app')
@section('title', 'Category Products')

@section('content') <div class="max-w-7xl mx-auto px-margin py-space-lg"> <div class="flex flex-col w-full">

```
        {{-- Header --}}
        <div class="flex flex-col gap-space-sm mb-space-lg">
            <div class="flex items-center gap-space-sm">
                <a href="{{ route('categories.index') }}"
                    title="Back to Categories"
                    class="flex items-center justify-center w-8 h-8 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface transition-colors">
                    <span class="material-symbols-outlined text-lg">arrow_back</span>
                </a>

                <div class="flex flex-col">
                    <span
                        class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">
                        Category
                    </span>

                    <h1 class="font-headline-lg text-headline-lg text-on-surface">
                        {{ $category->name }}
                    </h1>
                </div>
            </div>
        </div>

        {{-- Products Table --}}
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
                            <th class="py-space-md px-space-md text-center">Active Status</th>
                            <th class="py-space-md px-space-md text-center">Actions</th>

                        </tr>
                    </thead>

                    <tbody class="text-on-surface divide-y divide-surface-variant/20">

                        @forelse ($products as $product)

                            <tr class="hover:bg-surface-container-low transition-colors">

                                {{-- ID --}}
                                <td
                                    class="py-space-sm px-space-md font-label-md text-label-md font-medium text-on-surface-variant">
                                    {{ $product->id }}
                                </td>

                                {{-- Image --}}
                                <td class="py-space-sm px-space-md">
                                    <div
                                        class="w-12 h-12 rounded-lg bg-surface-container-high overflow-hidden shadow-sm flex items-center justify-center">

                                        @if($product->image)
                                            <img
                                                class="w-full h-full object-cover"
                                                src="{{ asset('storage/' . $product->image) }}"
                                                alt="{{ $product->name }}">
                                        @endif

                                    </div>
                                </td>

                                {{-- Name --}}
                                <td
                                    class="py-space-sm px-space-md font-medium text-on-surface whitespace-nowrap">
                                    {{ $product->name }}
                                </td>

                                {{-- SKU --}}
                                <td
                                    class="py-space-sm px-space-md font-label-sm text-label-sm font-semibold tracking-wide text-on-surface-variant whitespace-nowrap">
                                    {{ $product->sku }}
                                </td>

                                {{-- Description --}}
                                <td class="py-space-sm px-space-md text-on-surface-variant max-w-[220px]">
                                    <p class="line-clamp-2">
                                        {{ $product->description }}
                                    </p>
                                </td>

                                {{-- Price --}}
                                <td class="py-space-sm px-space-md text-right font-medium whitespace-nowrap">
                                    {{ $product->price }}
                                </td>

                                {{-- Quantity --}}
                                <td class="py-space-sm px-space-md text-right font-medium whitespace-nowrap">
                                    {{ $product->quantity }}
                                </td>

                                {{-- Active Status --}}
                                <td class="py-space-sm px-space-md text-center whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-space-sm py-0.5 rounded-full text-xs font-medium
                                        {{ $product->is_active
                                            ? 'bg-surface-container-high text-on-surface'
                                            : 'bg-error-container/60 text-error' }}">

                                        {{ $product->is_active ? 'Yes' : 'No' }}

                                    </span>
                                </td>

                                {{-- Actions --}}
                                <td class="py-space-sm px-space-md text-center whitespace-nowrap">
                                    <div
                                        class="inline-flex items-center gap-space-xs font-label-sm text-label-sm">

                                        <a href="{{ route('products.show', $product) }}"
                                            class="text-tertiary hover:underline px-1 py-0.5">
                                            Show
                                        </a>

                                        <span class="text-surface-container-highest">/</span>

                                        <a href="{{ route('products.edit', $product) }}"
                                            class="text-on-surface-variant hover:text-on-surface px-1 py-0.5">
                                            Edit
                                        </a>

                                        <span class="text-surface-container-highest">/</span>

                                        <form method="post"
                                            action="{{ route('products.delete', $product) }}"
                                            class="inline">

                                            @csrf
                                            @method('delete')

                                            <button type="submit"
                                                class="text-primary-container hover:text-red-600 px-1 py-0.5 cursor-pointer">
                                                Delete
                                            </button>

                                        </form>

                                    </div>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="9"
                                    class="py-12 text-center text-on-surface-variant">

                                    No products found in this category.

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>
            </div>
        </div>

        {{-- Pagination Information --}}
        <div
            class="flex flex-col sm:flex-row items-center justify-between gap-space-md pt-space-xs px-1">

            <p class="font-body-md text-body-md text-on-surface-variant">

                Showing {{ $products->firstItem() ?? 0 }}
                to {{ $products->lastItem() ?? 0 }}
                of {{ $products->total() }} results

            </p>

            <div>
                {{ $products->links() }}
            </div>

        </div>

    </div>
</div>
```

@endsection
