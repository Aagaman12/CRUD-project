<footer class="w-full bg-surface-container-lowest border-t border-surface-container-high">

    <div class="max-w-[1360px] mx-auto px-5 md:px-margin py-12 sm:py-16">

        {{-- Main footer --}}
        <div class="grid grid-cols-1 gap-10 md:grid-cols-3 md:gap-8">

            {{-- Brand --}}
            <div class="flex flex-col items-start">

                <a href="{{ route('home') }}" class="flex items-center gap-space-sm">
                    <span
                        class="w-11 h-11 rounded-lg bg-primary-container text-on-primary flex items-center justify-center">
                        <span class="material-symbols-outlined text-[22px]">
                            storefront
                        </span>
                    </span>

                    <span class="text-2xl font-bold tracking-tight text-on-surface">
                        {{ config('app.name') }}
                    </span>
                </a>

                <p class="mt-4 text-base leading-6 text-on-surface-variant max-w-sm">
                    A simple catalog of quality products, always up to date.
                </p>

            </div>


            {{-- Quick Links --}}
            <div class="flex flex-col items-start md:items-center">

                <span class="font-label-md text-label-md text-on-surface uppercase tracking-wider font-extrabold mb-5">
                    Quick Links
                </span>

                <ul class="flex flex-col items-start sm:items-center gap-3 text-base text-on-surface-variant">

                    <li>
                        <a href="{{ route('home') }}" class="hover:text-on-surface transition-colors">
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('public.shop') }}"
                            class="hover:text-on-surface items-center transition-colors">
                            Products
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('home') }}#how-it-works"
                            class="hover:text-on-surface items-center transition-colors">
                            How We Work
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('home') }}#testimonials"
                            class="hover:text-on-surface items-center transition-colors">
                            Testimonials
                        </a>
                    </li>

                </ul>

            </div>


            {{-- Account --}}
            <div class="flex flex-col items-start md:items-center">

    <span class="font-label-md text-label-md text-on-surface uppercase tracking-wider font-extrabold mb-5">
        Account
    </span>

    <ul class="flex flex-col items-start md:items-center gap-3 text-base text-on-surface-variant">

        @auth

            <li>
                <a href="{{ route('dashboard') }}"
                    class="hover:text-on-surface transition-colors">
                    Dashboard
                </a>
            </li>

        @else

            <li>
                <a href="{{ route('show.login') }}"
                    class="hover:text-on-surface transition-colors">
                    Login
                </a>
            </li>

            <li>
                <a href="{{ route('show.register') }}"
                    class="hover:text-on-surface transition-colors">
                    Register
                </a>
            </li>

        @endauth

    </ul>

</div>

            {{-- Copyright --}}
            <div class="mt-10 sm:mt-12 pt-6 border-t border-surface-container">

                <p class="text-sm text-on-surface-variant">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </p>

            </div>

        </div>

</footer>