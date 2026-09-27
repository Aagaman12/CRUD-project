@extends('layouts.app')
@section('title', 'Home')

@section('content')

    <div class="max-w-7xl mx-auto w-full px-margin py-space-xl flex flex-col gap-space-xl">
        <!-- Hero Header / Greeting -->
        <div
            class="relative overflow-hidden bg-surface-container-lowest rounded-xl p-space-xl shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-space-lg">
            <div
                class="absolute -right-16 -top-16 w-80 h-80 bg-primary-container/5 rounded-full pointer-events-none blur-2xl">
            </div>
            <div class="relative z-10 flex flex-col gap-space-xs max-w-2xl">
                <div class="flex items-center gap-space-xs">
                    <span
                        class="inline-flex items-center gap-1.5 px-space-sm py-0.5 rounded-full bg-surface-container text-on-surface-variant font-label-sm text-label-sm uppercase tracking-wider">
                        <span class="w-1.5 h-1.5 rounded-full bg-primary-container animate-pulse"></span>
                        Operational Hub
                    </span>
                    <span class="text-on-surface-variant/40 font-label-md text-label-md">/</span>
                    <span class="font-label-md text-label-md text-on-surface-variant">Inventory Console</span>
                </div>
                <h1 class="font-display-lg text-display-lg text-on-surface tracking-tight">
                    Welcome back, <span class="text-primary-container">Operator</span>
                </h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed">
                    Manage your enterprise catalog seamlessly. What would you like to accomplish today?
                </p>
            </div>
            <div
                class="relative z-10 flex items-center gap-space-md self-stretch md:self-auto bg-surface-container-low px-space-lg py-space-md rounded-lg">
                <div class="flex flex-col">
                    <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Catalog
                        Health</span>
                    <span class="font-headline-md text-headline-md text-on-surface">100% Synced</span>
                </div>
                <div
                    class="w-10 h-10 rounded-full bg-primary-container/10 flex items-center justify-center text-primary-container">
                    <span class="material-symbols-outlined text-primary-container"
                        style="font-variation-settings: 'FILL' 1;">check_circle</span>
                </div>
            </div>
        </div>
        <!-- Main Question Callout -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-space-sm">
            <div class="flex flex-col gap-space-xs">
                <span
                    class="font-label-sm text-label-sm uppercase tracking-widest text-primary-container font-semibold">Immediate
                    Dispatch</span>
                <h2 class="font-headline-lg text-headline-lg text-on-surface">Do you want to view products or create a new
                    product?</h2>
            </div>
            <div class="font-body-md text-body-md text-on-surface-variant">
                Select a pathway below to proceed to your inventory flow.
            </div>
        </div>
        <!-- Action Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg">
            <!-- Card 1: View Products / Catalog Index -->
            <div
                class="group relative bg-surface-container-lowest rounded-xl p-space-xl flex flex-col justify-between shadow-sm hover:shadow-md transition-all duration-200">
                <div class="flex flex-col gap-space-md">
                    <div class="flex items-center justify-between">
                        <div
                            class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center text-on-surface group-hover:bg-primary-container/10 group-hover:text-primary-container transition-colors">
                            <span class="material-symbols-outlined">inventory_2</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-space-xs">
                        <h3
                            class="font-headline-lg text-headline-lg text-on-surface group-hover:text-primary-container transition-colors">
                            View Products &amp; Catalog
                        </h3>
                        <p class="font-body-md text-body-md text-on-surface-variant">Browse, search, sort, and inspect your
                            active inventory catalog.</p>
                    </div>
                    <!-- Micro Visual Data Strip -->
                </div>
                <div class="pt-space-xl mt-space-md">
                    <a class="inline-flex items-center justify-between w-full px-space-lg py-space-md rounded-lg bg-surface-container-high text-on-surface font-label-lg text-label-lg hover:bg-surface-container-highest transition-colors group-hover:text-primary-container"
                        href="{{ route('products.index') }}">
                        <span class="flex items-center gap-space-sm">
                            <span class="material-symbols-outlined">table_rows</span>
                            Browse Product Catalog
                        </span>
                        <span class="material-symbols-outlined text-base">arrow_forward</span>
                    </a>
                </div>
            </div>
            <!-- Card 2: Create a New Product -->
            <div
                class="group relative bg-surface-container-lowest rounded-xl p-space-xl flex flex-col justify-between shadow-sm hover:shadow-md transition-all duration-200">
                <div class="flex flex-col gap-space-md">
                    <div class="flex items-center justify-between">
                        <div
                            class="w-12 h-12 rounded-lg bg-primary-container/10 flex items-center justify-center text-primary-container group-hover:bg-primary-container group-hover:text-on-primary transition-colors">
                            <span class="material-symbols-outlined">add_box</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-space-xs">
                        <h3
                            class="font-headline-lg text-headline-lg text-on-surface group-hover:text-primary-container transition-colors">
                            Create a New Product
                        </h3>
                        <p class="font-body-md text-body-md text-on-surface-variant">Add a new item to your inventory with
                            specifications, retail pricing, and rich asset attachments.</p>
                    </div>
                    <!-- Micro Visual Feature Points -->
                </div>
                <div class="pt-space-xl mt-space-md">
                    <a class="inline-flex items-center justify-between w-full px-space-lg py-space-md rounded-lg bg-primary-container text-on-primary font-label-lg text-label-lg hover:bg-primary transition-colors shadow-sm"
                        href="{{ route('products.create') }}">
                        <span class="flex items-center gap-space-sm">
                            <span class="material-symbols-outlined">add</span>
                            + Create New Product
                        </span>
                        <span class="material-symbols-outlined text-base">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- Quick Operational Overview Strip & Highlights -->
        <!-- Editorial Product Spotlight Teasers -->
    </div>
    
   


@endsection