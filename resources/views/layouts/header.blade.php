<header
    class="fixed top-0 w-full z-50 bg-surface-container-lowest/90 backdrop-blur-xl shadow-[0_1px_8px_rgba(0,0,0,0.04)]">
    <div class="h-16 max-w-7xl mx-auto px-margin flex items-center justify-between">
        <div class="flex items-center gap-space-lg">

            <div class="flex items-center gap-space-sm">
                <a href="{{ route('home') }}" class="flex items-center gap-space-sm">
                    <span class="material-symbols-outlined text-primary-container text-2xl">inventory_2</span>
                    <span class="font-headline-md text-headline-md tracking-tight text-on-surface">CRUD</span>
                </a>
            </div>

            <nav class="flex items-center gap-space-xs">
                @unless(request()->routeIs('products.index'))
                    <a href="{{ route('products.index') }}"
                        class="px-space-md py-space-xs rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-colors">
                        Products
                    </a>
                @else
                    <span
                        class="px-space-md py-space-xs rounded-lg font-label-lg text-label-lg bg-primary-container text-on-primary shadow-sm">
                        Products
                    </span>
                @endunless


                @unless(request()->routeIs('categories.index'))
                    <a href="{{ route('categories.index') }}"
                        class="px-space-md py-space-xs rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-colors">
                        Category
                    </a>
                @else
                    <span
                        class="px-space-md py-space-xs rounded-lg font-label-lg text-label-lg bg-primary-container text-on-primary shadow-sm">
                        Category
                    </span>
                @endunless


            </nav>
        </div>



        <div class="flex items-center gap-space-sm">
            @guest
                <a href="{{ route('show.login') }}"
                    class="px-space-md py-space-xs rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-colors">
                    Login
                </a>
                <a href="{{ route('show.register') }}"
                    class="px-space-md py-space-xs rounded-lg font-label-lg text-label-lg bg-primary-container text-on-primary shadow-sm hover:bg-primary transition-colors">
                    Register
                </a>
            @else
                <div class="flex items-center gap-space-sm pl-space-sm">
                    <span class="material-symbols-outlined text-on-surface-variant">account_circle</span>
                    <span class="hidden md:inline-block font-label-md text-label-md text-on-surface font-medium">
                        {{ auth()->user()->name }}
                    </span>
                </div>
                <div class="flex items-center pl-space-sm">
                <form action="{{ route('logout') }}" method="post">
                    @csrf

                    <button type="submit"
                        class="flex items-center gap-space-xs px-space-sm py-space-xs rounded-md font-label-md text-label-md text-on-surface-variant border border-outline-variant hover:bg-error-container hover:text-on-error-container transition-colors">
                        <span class="material-symbols-outlined" style="font-size: 18px;">
                            logout
                        </span>
                        <span>
                            Logout
                        </span>
                    </button>
                </form>
            </div>
            @endguest
            
        </div>

    </div>
</header>