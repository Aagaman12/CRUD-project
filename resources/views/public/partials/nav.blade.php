<header class="fixed top-0 left-0 w-full z-50 bg-surface-container-lowest/90 backdrop-blur-xl border-b border-surface-container">
    <div class="h-20 max-w-[1360px] mx-auto px-5 md:px-margin
                grid grid-cols-2 lg:grid-cols-3 items-center">

        {{-- Logo --}}
        <div class="flex items-center justify-start">
            <a href="{{ route('home') }}" class="flex items-center gap-space-sm">
                <span class="w-9 h-9 rounded-lg bg-primary-container text-on-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-[20px]">
                        storefront
                    </span>
                </span>

                <span class="text-2xl font-bold tracking-tight text-on-surface">
                    {{ config('app.name') }}
                </span>
            </a>
        </div>


        {{-- Navigation --}}
        <nav class="hidden lg:flex items-center justify-center gap-12 text-base font-medium text-on-surface-variant whitespace-nowrap">

            <a href="{{ route('home') }}"
                class="font-semibold hover:text-secondary transition-colors">
                Home
            </a>

            <a href="{{ route('public.dashboard.shop') }}"
                class="font-semibold hover:text-secondary transition-colors">
                Products
            </a>

            <a href="{{ route('home') }}#how-we-work"
                class="font-semibold hover:text-secondary transition-colors">
                How We Work
            </a>

            <a href="{{ route('home') }}#testimonials"
                class="font-semibold hover:text-secondary transition-colors">
                Testimonials
            </a>

        </nav>


        {{-- Right Side --}}
        <div class="flex items-center justify-end gap-3">

            {{-- Mobile Hamburger --}}
            <div class="lg:hidden">
                <details class="relative">

                    <summary
                        class="list-none cursor-pointer flex items-center justify-center
                               w-10 h-10 rounded-lg
                               hover:bg-surface-container transition-colors">

                        <span class="material-symbols-outlined text-2xl">
                            menu
                        </span>

                    </summary>

                    {{-- Mobile Menu --}}
                    <div
                        class="absolute right-0 top-12 w-52
                               bg-surface-container-lowest
                               rounded-xl shadow-lg
                               border border-outline-variant/20
                               p-3 z-50">

                        <a href="{{ route('home') }}"
                            class="block px-4 py-3 rounded-lg font-semibold hover:bg-surface-container transition-colors">
                            Home
                        </a>

                        <a href="{{ route('home') }}#products"
                            class="block px-4 py-3 rounded-lg font-semibold hover:bg-surface-container transition-colors">
                            Products
                        </a>

                        <a href="{{ route('home') }}#how-we-work"
                            class="block px-4 py-3 rounded-lg font-semibold hover:bg-surface-container transition-colors">
                            How We Work
                        </a>

                        <a href="{{ route('home') }}#testimonials"
                            class="block px-4 py-3 rounded-lg font-semibold hover:bg-surface-container transition-colors">
                            Testimonials
                        </a>

                    </div>

                </details>
            </div>


            {{-- Authentication --}}
            @auth

                <div class="flex items-center gap-space-sm pl-space-sm">

                    <span class="material-symbols-outlined text-on-surface-variant">
                        account_circle
                    </span>

                    <span class="hidden md:inline-block font-label-md text-label-md text-on-surface font-medium">
                        {{ auth()->user()->name }}
                        ({{ Auth::user()->roles->pluck('name')->implode(', ') }})
                    </span>

                </div>

                <a href="{{ route('dashboard') }}"
                    class="sm:block px-space-lg py-space-sm rounded-xl
                           font-label-md text-label-md
                           bg-primary-container text-on-primary
                           hover:bg-secondary transition-all">
                    Dashboard
                </a>

            @else

                <a href="{{ route('show.login') }}"
                    class=" sm:block px-space-md py-space-sm rounded-xl
                           text-base font-medium text-on-surface
                           border border-outline-variant
                           hover:bg-surface-container transition-all">
                    Login
                </a>

                <a href="{{ route('show.register') }}"
                    class=" sm:block px-space-lg py-space-sm rounded-xl
                           text-base font-medium
                           bg-primary-container text-on-primary
                           hover:bg-secondary transition-all shadow-sm">
                    Register
                </a>

            @endauth

        </div>

    </div>
</header>