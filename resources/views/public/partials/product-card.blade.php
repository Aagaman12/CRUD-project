<article
    class="group relative bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col">

    <div class="relative aspect-[4/5] bg-surface-container-low overflow-hidden">
        @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" loading="lazy"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
        @else
            <div class="w-full h-full flex items-center justify-center text-on-surface-variant">
                <span class="material-symbols-outlined text-5xl">image</span>
            </div>
        @endif

        <div class="absolute top-3 left-3 flex flex-wrap gap-1.5">
            @if ($product->category)
                <span class="px-2.5 py-1 rounded-full font-label-sm text-label-sm bg-surface-container-lowest/90 text-on-surface backdrop-blur-sm">
                    {{ $product->category->name }}
                </span>
            @endif

            @if ($product->quantity < 1)
                <span class="px-2.5 py-1 rounded-full font-label-sm text-label-sm bg-error-container/80 text-error backdrop-blur-sm">Out of stock</span>
            @elseif ($product->quantity <= 5)
                <span class="px-2.5 py-1 rounded-full font-label-sm text-label-sm bg-secondary/10 text-secondary backdrop-blur-sm">Only {{ $product->quantity }} left</span>
            @else
                <span class="px-2.5 py-1 rounded-full font-label-sm text-label-sm bg-surface-container-high/90 text-on-surface backdrop-blur-sm">In stock</span>
            @endif
        </div>
    </div>

    <div class="p-space-md flex flex-col flex-1 gap-space-xs">
        <span class="font-label-sm text-label-sm text-on-surface-variant">SKU: {{ $product->sku }}</span>
        <h3 class="text-lg font-semibold text-on-surface group-hover:text-secondary transition-colors">
    <a href="{{ route('public.dashboard.show', $product) }}" class="after:absolute after:inset-0">
        {{ $product->name }}
    </a>
</h3>
        <p class="text-sm text-on-surface-variant line-clamp-2">{{ $product->description }}</p>
        <p class="mt-auto pt-space-sm text-xl font-bold text-on-surface">
            $ {{ number_format($product->price, 2) }}
        </p>
    </div>
</article>