@extends('layouts.app')
@section('title', 'Show Products')
@section('content')

<div class="bg-surface-container-lowest rounded-xl shadow-sm p-space-md sm:p-space-xl flex flex-col gap-space-xl">
    <!-- Section Title & Status Header -->
    <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-space-md">
        <div class="flex flex-col gap-space-xs">
            <span class="font-label-sm text-label-sm uppercase tracking-wider text-primary font-bold">Catalog SKU • {{ $product->sku }}</span>
            <h1 class="font-headline-lg text-headline-lg text-on-surface">Product Details</h1>
        </div>
        <div class="flex items-center gap-space-sm self-start">
            @if($product->is_active)
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 font-label-md text-label-md font-semibold">
                    <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                    Active
                </span>
            @else
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-50 text-red-700 font-label-md text-label-md font-semibold">
                    <span class="w-2 h-2 rounded-full bg-red-600"></span>
                    Inactive
                </span>
            @endif
            <button class="p-2 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface-variant transition-colors" title="Print Catalog Entry" type="button" onclick="window.print()">
                <span class="material-symbols-outlined text-[20px]">print</span>
            </button>
        </div>
    </div>

    <!-- Content Split Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl">
        <!-- Visual Gallery Column -->
        <div class="lg:col-span-5 flex flex-col gap-space-md">
            <div class="relative w-full aspect-square rounded-xl bg-surface-container overflow-hidden group">
                @if($product->image)
                    <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                         src="{{ asset('storage/' . $product->image) }}"
                         alt="{{ $product->name }}">
                @else
                    <div class="w-full h-full flex items-center justify-center text-on-surface-variant">
                        <span class="material-symbols-outlined text-[64px]">image_not_supported</span>
                    </div>
                @endif
                <div class="absolute bottom-3 left-3 bg-surface-container-lowest/80 backdrop-blur-md px-2.5 py-1 rounded-md font-label-sm text-label-sm text-on-surface shadow-sm">
                    Primary View
                </div>
            </div>
        </div>

        <!-- Specifications & Info Column -->
        <div class="lg:col-span-7 flex flex-col justify-between gap-space-lg">
            <div class="flex flex-col gap-space-lg">
                <!-- Product Title & SKU -->
                <div class="flex flex-col gap-space-xs">
                    <span class="font-label-md text-label-md text-on-surface-variant">Product Name</span>
                    <h2 class="font-display-lg text-display-lg text-on-surface font-semibold leading-tight">
                        {{ $product->name }}
                    </h2>
                </div>

                <p>Category: {{ $product->category->name }}</p>

                <!-- Price & Stock Highlights -->
                <div class="grid grid-cols-2 gap-space-md">
                    <div class="p-space-md rounded-xl bg-surface-container-low flex flex-col gap-space-xs">
                        <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant font-medium">Unit Price</span>
                        <div class="flex items-baseline gap-1">
                            <span class="font-display-lg text-display-lg font-bold text-primary">${{ number_format($product->price, 2) }}</span>
                            <span class="font-label-sm text-label-sm text-on-surface-variant">USD</span>
                        </div>
                    </div>
                    <div class="p-space-md rounded-xl bg-surface-container-low flex flex-col gap-space-xs">
                        <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant font-medium">Available Quantity</span>
                        <div class="flex items-baseline gap-2">
                            <span class="font-display-lg text-display-lg font-bold text-on-surface">{{ $product->quantity }}</span>
                            <span class="font-label-sm text-label-sm text-emerald-700 font-semibold">Units in Stock</span>
                        </div>
                    </div>
                </div>

                <!-- Detailed Specifications Data List -->
                <div class="flex flex-col gap-space-md">
                    <!-- SKU Row -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between py-space-sm bg-surface-container-lowest">
                        <div class="flex items-center gap-space-sm text-on-surface-variant">
                            <span class="material-symbols-outlined text-[20px]">qr_code_2</span>
                            <span class="font-label-lg text-label-lg font-medium">Inventory SKU</span>
                        </div>
                        <div class="flex items-center gap-2 mt-1 sm:mt-0">
                            <span class="font-label-lg text-label-lg font-mono text-on-surface bg-surface-container px-2.5 py-1 rounded">{{ $product->sku }}</span>
                            <button class="p-1 text-on-surface-variant hover:text-primary transition-colors" onclick="navigator.clipboard.writeText('{{ $product->sku }}')" title="Copy SKU" type="button">
                                <span class="material-symbols-outlined text-[18px]">content_copy</span>
                            </button>
                        </div>
                    </div>

                    <!-- Description Block -->
                    <div class="flex flex-col gap-space-xs py-space-sm">
                        <div class="flex items-center gap-space-sm text-on-surface-variant">
                            <span class="material-symbols-outlined text-[20px]">description</span>
                            <span class="font-label-lg text-label-lg font-medium">Description</span>
                        </div>
                        <p class="font-body-lg text-body-lg text-on-surface leading-relaxed pl-7">
                            {{ $product->description }}
                        </p>
                    </div>

                    <!-- Active Status Info Row -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between py-space-sm bg-surface-container-lowest">
                        <div class="flex items-center gap-space-sm text-on-surface-variant">
                            <span class="material-symbols-outlined text-[20px]">toggle_on</span>
                            <span class="font-label-lg text-label-lg font-medium">Publishing Status</span>
                        </div>
                        <div class="flex items-center gap-2 mt-1 sm:mt-0">
                            @if($product->is_active)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md bg-emerald-100 text-emerald-800 font-label-md text-label-md font-semibold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                                    Active (Yes)
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md bg-red-100 text-red-800 font-label-md text-label-md font-semibold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span>
                                    Inactive (No)
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Action Buttons Strip -->
            <div class="pt-space-md flex flex-wrap items-center justify-between gap-space-md">
                <div class="flex items-center gap-space-sm">
                    <a class="px-space-lg py-space-sm rounded-lg bg-primary-container text-on-primary hover:bg-primary font-label-lg text-label-lg shadow-sm transition-all duration-150 inline-flex items-center gap-space-xs font-semibold"
                       href="{{ route('products.edit', $product) }}">
                        <span class="material-symbols-outlined text-[20px]">edit</span>
                        <span>Edit Product</span>
                    </a>
                    
                </div>
                <div>
                    <form action="{{ route('products.delete', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                        @csrf
                        @method('DELETE')
                        <button class="px-space-md py-space-sm rounded-lg bg-error-container text-on-error-container hover:bg-error hover:text-on-error font-label-lg text-label-lg transition-colors inline-flex items-center gap-space-xs font-medium" type="submit">
                            <span class="material-symbols-outlined text-[18px]">delete</span>
                            <span>Delete</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection