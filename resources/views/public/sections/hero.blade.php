<section class="relative w-full overflow-hidden bg-surface py-12 lg:py-20">

    {{-- Background image + overlay (falls back to plain background if no file) --}}
    @if (file_exists(public_path('images/hero-bg.jpeg')))
        <img
    src="{{ asset('images/hero-bg.jpeg') }}"
    alt=""
    aria-hidden="true"
    class="absolute inset-0 w-full h-full object-cover
           object-[30%_center]
           sm:object-[35%_center]
           lg:object-[40%_center]">
        <div class="absolute inset-0 bg-surface/70"></div>
    @endif

    <div class="relative z-10 max-w-[1360px] mx-auto px-5 md:px-margin">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center">

            <div class="lg:col-span-7 flex flex-col items-start">
                <span
                    class="inline-flex items-center gap-space-xs px-space-md py-1.5 rounded-full bg-secondary/10 text-secondary font-label-md text-label-md mb-space-lg">
                    <span class="material-symbols-outlined text-[18px]">auto_awesome</span>
                    New arrivals, updated live
                </span>

                <h1 class="font-display-lg text-display-lg text-on-surface tracking-tight mb-space-md">
                    Discover Products <span class="text-secondary">You'll Love</span>
                </h1>

                <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mb-space-xl">
                    Explore our collection of quality products, carefully selected to make everyday shopping simple,
                    reliable, and delightful.
                </p>

                <div class="flex flex-wrap items-center gap-space-md w-full sm:w-auto">
                    <a href="#products"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-space-xs px-space-xl h-12 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md shadow-md hover:bg-secondary transition-all">
                        <span>Explore Products</span>
                        <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                    </a>
                    <a href="#how-it-works"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-space-xs px-space-lg h-12 rounded-xl bg-surface-container-lowest text-on-surface font-label-md text-label-md shadow-sm hover:bg-surface-container transition-all">
                        <span class="material-symbols-outlined text-[20px]">play_circle</span>
                        <span>How It Works</span>
                    </a>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="relative rounded-xl overflow-hidden bg-surface-container-low shadow-xl aspect-[4/5]">
                    @if (file_exists(public_path('images/hero.gif')))
                        <img src="{{ asset('images/hero.gif') }}" alt="Featured products"
                            class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-on-surface-variant">
                            <span class="material-symbols-outlined text-7xl">shopping_bag</span>
                        </div>
                    @endif

                    <div
                        class="absolute top-4 left-4 bg-surface-container-lowest/90 backdrop-blur-md px-3.5 py-2 rounded-xl shadow-md flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-secondary animate-pulse"></span>
                        <span class="font-label-sm text-label-sm text-on-surface uppercase tracking-wider">GRAB IT</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>