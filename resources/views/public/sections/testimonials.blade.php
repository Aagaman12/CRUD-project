@php
    // Placeholder content. Replace with real customer feedback before going live.
    $testimonials = [
        ['name' => 'Prachanda', 'role' => 'Verified Buyer', 'quote' => 'The catalog is clean and easy to browse. I found what I needed in minutes.'],
        ['name' => 'Kp Oli', 'role' => 'Frequent Shopper', 'quote' => 'Product details and availability were clear, with no surprises.'],
        ['name' => 'Sher Bahadur Deuba', 'role' => 'Verified Buyer', 'quote' => 'A simple, uncluttered site that makes comparing products easy.'],
    ];
@endphp

<section id="testimonials" class="w-full py-16 lg:py-24 bg-surface scroll-mt-20">
    <div class="max-w-[1360px] mx-auto px-5 md:px-margin">

        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="font-label-md text-label-md text-secondary font-semibold uppercase tracking-wider block mb-space-xs">Testimonials</span>
            <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight mb-space-sm">What Customers Say</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-space-lg">
            @foreach ($testimonials as $t)
                <article class="p-space-xl rounded-xl bg-surface-container-lowest shadow-sm flex flex-col gap-space-lg">
                    <div class="flex items-center gap-1 text-secondary">
                        @for ($i = 0; $i < 5; $i++)
                            <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
                        @endfor
                    </div>
                    <p class="font-body-md text-body-md text-on-surface leading-relaxed">"{{ $t['quote'] }}"</p>
                    <div class="flex items-center gap-space-sm mt-auto">
                        <div class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface font-bold">
                            {{ strtoupper(substr($t['name'], 0, 1)) }}
                        </div>
                        <div class="flex flex-col">
                            <span class="font-semibold text-on-surface">{{ $t['name'] }}</span>
                            <span class="text-sm text-on-surface-variant">{{ $t['role'] }}</span>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>