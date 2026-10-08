@php
    $steps = [
        ['icon' => 'manage_search', 'title' => 'Browse the Catalog', 'text' => 'Explore every product we have, straight from our live inventory.'],
        ['icon' => 'tune', 'title' => 'Filter by Category', 'text' => 'Narrow things down by category to quickly find what fits your needs.'],
        ['icon' => 'inventory_2', 'title' => 'Check Availability', 'text' => 'Prices and stock levels are always up to date, so you know what is available.'],
    ];
@endphp

<section id="how-we-work" class="w-full py-16 lg:py-24 bg-surface scroll-mt-20">
    <div class="max-w-[1360px] mx-auto px-5 md:px-margin">

        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="font-label-md text-label-md text-secondary font-semibold uppercase tracking-wider block mb-space-xs">Simple Process</span>
            <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight mb-space-sm">How We Work</h2>
            <p class="font-body-md text-body-md text-on-surface-variant">Finding the right product takes just a few steps.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-space-lg">
            @foreach ($steps as $step)
                <article
                    class="group p-space-lg rounded-xl bg-[#ffffff] transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-space-lg">
                        <div
                            class="w-12 h-12 rounded-xl text-on-surface flex items-center justify-center shadow-sm group-hover:bg-primary-container group-hover:text-on-primary transition-colors">
                            <span class="material-symbols-outlined text-[24px]">{{ $step['icon'] }}</span>
                        </div>
                        <span class="font-label-md text-label-md px-3 py-1 rounded-full bg-surface-container text-on-surface-variant font-bold">
                            0{{ $loop->iteration }}
                        </span>
                    </div>
                    <h3 class="text-lg font-semibold text-on-surface mb-space-xs">{{ $step['title'] }}</h3>
                    <p class="text-sm text-on-surface-variant">{{ $step['text'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>