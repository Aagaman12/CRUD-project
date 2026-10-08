@extends('layouts.public')

@section('content')
    <section class="w-full py-12 lg:py-16 bg-surface min-h-[60vh]">
        <div class="max-w-[1360px] mx-auto px-5 md:px-margin">

            <div class="flex items-center justify-between mb-space-lg">
                <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">
                    Your Cart
                </h1>

                @if (!$items->isEmpty())
                    <label class="flex items-center gap-space-xs text-sm font-medium text-on-surface">
                        <input type="checkbox" id="select-all" class="w-4 h-4">
                        <span>Select All</span>
                    </label>
                @endif
            </div>

           @include('layouts.session')

            @if ($items->isEmpty())

                <div class="text-center py-16 rounded-xl bg-surface-container-low">

                    <span class="material-symbols-outlined text-[56px] text-on-surface-variant">
                        shopping_cart
                    </span>

                    <p class="text-on-surface-variant mt-space-sm mb-space-md">
                        Your cart is empty.
                    </p>

                    <a href="{{ route('public.dashboard.shop') }}"
                        class="inline-flex items-center gap-space-xs px-space-lg py-space-sm rounded-lg bg-primary-container text-on-primary hover:bg-primary font-semibold shadow-sm transition-all">
                        <span>Browse Products</span>

                        <span class="material-symbols-outlined text-[20px]">
                            arrow_forward
                        </span>
                    </a>

                </div>

            @else

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-space-lg items-start">

                    {{-- Cart Products --}}
                    <div class="lg:col-span-2 flex flex-col gap-space-md">

                        @foreach ($items as $item)

                            @php
                                $product = $item['product'];
                            @endphp

                            <article
                                class="flex flex-col sm:flex-row gap-space-md p-space-md rounded-xl bg-surface-container-lowest shadow-sm">

                                {{-- Individual Select --}}
                                <div class="flex items-start pt-1">
                                    <input type="checkbox" name="selected_products[]" value="{{ $product->id }}"
                                        data-price="{{ $item['subtotal'] }}" class="product-checkbox w-4 h-4">
                                </div>

                                {{-- Product Image --}}
                                <div
                                    class="w-full sm:w-28 h-28 shrink-0 rounded-lg bg-surface-container-low overflow-hidden flex items-center justify-center">

                                    @if ($product->image)

                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            class="w-full h-full object-cover">

                                    @else

                                        <span class="material-symbols-outlined text-[36px] text-on-surface-variant">
                                            image
                                        </span>

                                    @endif

                                </div>

                                {{-- Product Details --}}
                                <div class="flex-1 flex flex-col justify-between gap-space-sm">

                                    <div class="flex items-start justify-between gap-space-sm">

                                        <div>
                                            <h3 class="text-lg font-semibold text-on-surface">
                                                {{ $product->name }}
                                            </h3>

                                            <p class="text-sm text-on-surface-variant">
                                                $ {{ number_format($product->price, 2) }}
                                            </p>
                                        </div>

                                        <p class="text-lg font-semibold text-on-surface whitespace-nowrap">
                                            $ {{ number_format($item['subtotal'], 2) }}
                                        </p>

                                    </div>

                                    {{-- Buy + Remove --}}
                                    <div class="flex flex-wrap items-center justify-end gap-space-sm">

                                        {{-- Buy --}}
                                        <a href="#"
                                            class="inline-flex items-center gap-space-xs px-space-md py-space-sm rounded-lg bg-[#46ac4b] text-on-primary hover:bg-[#0e6813] font-medium shadow-sm transition-all">

                                            <span class="material-symbols-outlined text-[18px]">
                                                shopping_bag
                                            </span>

                                            <span>Buy</span>

                                        </a>

                                        {{-- Remove --}}
                                        <form action="{{ route('cart.remove', $product->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="inline-flex items-center gap-space-xs px-space-md py-space-sm rounded-lg bg-surface-container-low text-on-surface hover:bg-surface-container-high font-medium shadow-sm transition-all">

                                                <span class="material-symbols-outlined text-[18px]">
                                                    delete
                                                </span>

                                                <span>Remove</span>

                                            </button>
                                        </form>

                                    </div>

                                </div>

                            </article>

                        @endforeach

                    </div>

                    {{-- Order Summary --}}
                    {{-- Order Summary --}}
                    <aside class="p-space-lg rounded-xl bg-surface-container-low lg:sticky lg:top-24">

                        <h2 class="text-lg font-semibold text-on-surface mb-space-md">
                            Order Summary
                        </h2>

                        {{-- Subtotal --}}
                        <div class="flex justify-between text-sm text-on-surface-variant mb-space-sm">
                            <span>Subtotal</span>

                            <span id="cart-subtotal">
                                $ 0.00
                            </span>
                        </div>

                        {{-- Shipping --}}
                        <div class="flex justify-between text-sm text-on-surface-variant mb-space-md">
                            <span>Shipping Fee</span>

                            <span id="shipping-fee">
                                $ 0.00
                            </span>
                        </div>

                        {{-- Total --}}
                        <div
                            class="flex justify-between text-lg font-semibold text-on-surface pt-space-md border-t border-outline-variant mb-space-lg">

                            <span>Total</span>

                            <span id="cart-total">
                                $ 0.00
                            </span>

                        </div>

                        {{-- Checkout --}}
                        <button type="button"
                            class="w-full px-space-lg py-space-sm rounded-lg bg-primary-container text-on-primary hover:bg-primary font-semibold shadow-sm transition-all">

                            Proceed to Checkout

                        </button>

                        <a href="{{ route('public.dashboard.shop') }}"
                            class="block text-center mt-space-sm text-sm font-medium text-on-surface-variant hover:text-on-surface transition-colors">

                            Continue shopping

                        </a>

                    </aside>

                </div>

            @endif

        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const selectAll = document.getElementById('select-all');
            const productCheckboxes = document.querySelectorAll('.product-checkbox');

            if (!selectAll) {
                return;
            }

            // Select / unselect all products
            selectAll.addEventListener('change', function () {
                productCheckboxes.forEach(function (checkbox) {
                    checkbox.checked = selectAll.checked;
                });
            });

            // Update Select All when individual products are selected/unselected
            productCheckboxes.forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {

                    const allSelected = [...productCheckboxes]
                        .every(function (checkbox) {
                            return checkbox.checked;
                        });

                    selectAll.checked = allSelected;
                });
            });

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const selectAll = document.getElementById('select-all');
            const productCheckboxes = document.querySelectorAll('.product-checkbox');

            const subtotalElement = document.getElementById('cart-subtotal');
            const shippingElement = document.getElementById('shipping-fee');
            const totalElement = document.getElementById('cart-total');

            function updateTotal() {

                let subtotal = 0;

                productCheckboxes.forEach(function (checkbox) {

                    if (checkbox.checked) {
                        subtotal += parseFloat(checkbox.dataset.price);
                    }

                });

                const shipping = subtotal > 0 ? 20 : 0;
                const total = subtotal + shipping;

                subtotalElement.textContent =
                    '$  ' + subtotal.toFixed(2);

                shippingElement.textContent =
                    '$  ' + shipping.toFixed(2);

                totalElement.textContent =
                    '$  ' + total.toFixed(2);
            }

            // Individual product selection
            productCheckboxes.forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {
                    updateTotal();
                });
            });

            // Select all
            if (selectAll) {
                selectAll.addEventListener('change', function () {

                    productCheckboxes.forEach(function (checkbox) {
                        checkbox.checked = selectAll.checked;
                    });

                    updateTotal();
                });
            }

            // Initial total
            updateTotal();

        });
    </script>
@endsection