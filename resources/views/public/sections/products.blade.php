<section id="products" class="w-full py-16 lg:py-24 bg-surface scroll-mt-20 ">
    <div class="max-w-[1360px] mx-auto px-5 md:px-margin">

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-space-md mb-space-xl" >
            <div>
                <span class="font-label-md text-label-md text-secondary font-semibold uppercase tracking-wider block mb-space-xs">Live Catalog</span>
                <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Featured Products</h2>
                <p class="text-base font-medium text-on-surface-variant mt-1 max-w-xl">
                    Our latest products, pulled straight from our inventory.
                </p>
            </div>
            <a href="{{ route('public.shop') }}"
                class="inline-flex items-center gap-space-xs text-base font-medium text-on-surface  hover:text-secondary transition-colors self-start md:self-auto">
                <span>View All Products</span>
                <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
            </a>
        </div>

        {{-- Category chips: each one opens the shop page filtered by that category --}}
        <div class="flex items-center gap-space-xs overflow-x-auto pb-space-sm mb-space-xl">
            <a href="{{ route('public.shop') }}"
                class="px-space-md py-2 rounded-full text-base font-medium shrink-0 bg-primary-container text-on-primary shadow-sm">
                All Products
            </a>
            @foreach ($categories as $category)
                <a href="{{ route('public.shop', ['category' => $category->id]) }}"
                    class="px-space-md py-2 rounded-full text-base font-medium shrink-0 bg-surface-container-low text-on-surface hover:bg-surface-container transition-colors">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-space-lg">
            @forelse ($products as $product)
                @include('public.partials.product-card', ['product' => $product])
            @empty
                <p class="col-span-full text-center text-on-surface-variant py-12">
                    No products available yet.
                </p>
            @endforelse
        </div>
    </div>
</section>