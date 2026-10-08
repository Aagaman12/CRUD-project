@extends('layouts.public')
@section('title', 'Edit Page')

@section('content')
    <div class="w-full bg-surface-container-lowest shadow-sm mb-space-lg">
        <div
            class="max-w-7xl mx-auto px-margin py-space-md flex flex-col md:flex-row md:items-center justify-between gap-space-sm">
            <div class="flex flex-col gap-space-xs">
                <nav
                    class="flex items-center gap-space-xs font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">
                    <a href="{{ route('public.dashboard.shop') }}" class="hover:text-primary transition-colors">Catalog</a>
                    <span class="text-outline">/</span>
                    <span class="text-primary font-semibold">{{ $product->name }}</span>
                </nav>
                <div class="flex items-center gap-space-sm">
                    <a href="{{ route('public.dashboard.shop') }}" title="Back to Shop"
                        class="flex items-center justify-center w-8 h-8 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface transition-colors">
                        <span class="material-symbols-outlined text-lg">arrow_back</span>
                    </a>
                    <h1 class="font-headline-lg text-headline-lg text-on-surface">Update Your Product</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-margin w-full pb-space-xl">
        <form method="post" action="{{ route('public.update', $product) }}" enctype="multipart/form-data"
            class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg items-start">
            @csrf
            @method('put')

            <div class="lg:col-span-8 flex flex-col gap-space-lg">

                <div class="bg-surface-container-lowest rounded-xl shadow-sm p-space-lg flex flex-col gap-space-md">
                    <div class="flex items-center gap-space-xs pb-space-xs">
                        <span class="w-2 h-4 bg-primary-container rounded-sm"></span>
                        <h2 class="font-headline-md text-headline-md text-on-surface">General Information</h2>
                    </div>

                    <div class="flex flex-col gap-space-xs">
                        <label class="font-label-lg text-label-lg text-on-surface">Product Name</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}"
                            class="w-full px-space-md py-space-sm rounded-lg bg-surface-container-low text-on-surface font-body-md text-body-md placeholder:text-outline focus:outline-none focus:bg-surface-container-lowest shadow-inner transition-colors" />
                        @include('layouts.product-error', ['name' => 'name'])
                    </div>

                    <div class="flex flex-col gap-space-xs">
                    <label class="font-label-lg text-label-lg text-on-surface">Category</label>
                    <select name="category_id"
                        class="w-full appearance-none px-space-md py-space-sm rounded-lg bg-surface-container-low text-on-surface font-body-md text-body-md focus:outline-none focus:bg-surface-container-lowest shadow-inner transition-colors">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected((int) old('category_id', $product->category_id) === $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @include('layouts.product-error', ['name' => 'category_id'])
                </div>

                    <div class="flex flex-col gap-space-xs">
                        <label class="font-label-lg text-label-lg text-on-surface">SKU</label>
                        <input type="text" name="sku" value="{{ old('sku', $product->sku) }}"
                            class="w-full uppercase px-space-md py-space-sm rounded-lg bg-surface-container-low text-on-surface font-label-md text-label-md tracking-wider placeholder:text-outline focus:outline-none focus:bg-surface-container-lowest shadow-inner transition-colors" />
                        @include('layouts.product-error', ['name' => 'sku'])
                    </div>

                    <div class="flex flex-col gap-space-xs">
                        <label class="font-label-lg text-label-lg text-on-surface">Description</label>
                        <textarea name="description" rows="5"
                            class="w-full px-space-md py-space-sm rounded-lg bg-surface-container-low text-on-surface font-body-md text-body-md placeholder:text-outline focus:outline-none focus:bg-surface-container-lowest shadow-inner transition-colors resize-y">{{ old('description', $product->description) }}</textarea>
                        @include('layouts.product-error', ['name' => 'description'])
                    </div>
                </div>

                <div class="bg-surface-container-lowest rounded-xl shadow-sm p-space-lg flex flex-col gap-space-md">
                    <div class="flex items-center gap-space-xs pb-space-xs">
                        <span class="w-2 h-4 bg-primary-container rounded-sm"></span>
                        <h2 class="font-headline-md text-headline-md text-on-surface">Pricing &amp; Allocation</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                        <div class="flex flex-col gap-space-xs">
                            <label class="font-label-lg text-label-lg text-on-surface">Price (USD)</label>
                            <div class="relative flex items-center">
                                <span
                                    class="absolute left-3 font-label-md text-label-md text-on-surface-variant select-none">$</span>
                                <input type="text" name="price" value="{{ old('price', $product->price) }}"
                                    class="w-full pl-8 pr-space-md py-space-sm rounded-lg bg-surface-container-low text-on-surface font-label-md text-label-md placeholder:text-outline focus:outline-none focus:bg-surface-container-lowest shadow-inner transition-colors" />
                            </div>
                            @include('layouts.product-error', ['name' => 'price'])
                        </div>

                        <div class="flex flex-col gap-space-xs">
                            <label class="font-label-lg text-label-lg text-on-surface">Available Quantity</label>
                            <div class="relative flex items-center">
                                <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}"
                                    class="w-full pl-space-md pr-16 py-space-sm rounded-lg bg-surface-container-low text-on-surface font-label-md text-label-md placeholder:text-outline focus:outline-none focus:bg-surface-container-lowest shadow-inner transition-colors" />
                                <span
                                    class="absolute right-3 font-label-sm text-label-sm text-on-surface-variant select-none">Units</span>
                            </div>
                            @include('layouts.product-error', ['name' => 'quantity'])
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 flex flex-col gap-space-lg">

                <div class="bg-surface-container-lowest rounded-xl shadow-sm p-space-lg flex flex-col gap-space-md">
                    <div class="flex items-center gap-space-xs pb-space-xs">
                        <span class="w-2 h-4 bg-primary-container rounded-sm"></span>
                        <h2 class="font-headline-md text-headline-md text-on-surface">Product Image</h2>
                    </div>

                    @if($product->image)
                        <div class="flex flex-col items-center gap-space-xs">
                            <span class="font-label-sm text-label-sm text-on-surface-variant self-start">Current image</span>
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="w-full h-32 object-cover rounded-lg shadow-sm" />
                        </div>
                    @endif

                    <div
                        class="relative rounded-xl bg-surface-container-low p-space-lg flex flex-col items-center justify-center text-center gap-space-sm">
                        <input type="file" name="image" accept="image/*" id="imageInput"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="
                                       const file = this.files[0];
                                       if (file) {
                                           const reader = new FileReader();
                                           reader.onload = function(e) {
                                               const preview = document.getElementById('imgPreview');
                                               const placeholder = document.getElementById('uploadPlaceholder');
                                               preview.src = e.target.result;
                                               preview.classList.remove('hidden');
                                               placeholder.classList.add('hidden');
                                           };
                                           reader.readAsDataURL(file);
                                       }
                                   " />
                        <div id="uploadPlaceholder" class="flex flex-col items-center gap-space-xs">
                            <div
                                class="w-14 h-14 rounded-full bg-surface-container-high flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined text-2xl">cloud_upload</span>
                            </div>
                            <span
                                class="font-label-lg text-label-lg text-on-surface">{{ $product->image ? 'Replace image' : 'Drop imagery or click to browse' }}</span>
                            <span class="font-body-sm text-body-sm text-on-surface-variant">PNG, JPG, or WEBP up to
                                2MB</span>
                        </div>
                        <img id="imgPreview" class="hidden w-full h-32 object-cover rounded-lg" alt="Preview" />
                    </div>
                    @include('layouts.product-error', ['name' => 'image'])
                </div>

                <div class="bg-surface-container-lowest rounded-xl shadow-sm p-space-lg flex flex-col gap-space-md">
                    <div class="flex items-center gap-space-xs pb-space-xs">
                        <span class="w-2 h-4 bg-primary-container rounded-sm"></span>
                        <h2 class="font-headline-md text-headline-md text-on-surface">Publishing &amp; Status</h2>
                    </div>

                    <label
                        class="flex items-start gap-space-sm p-space-sm rounded-lg bg-surface-container-low cursor-pointer hover:bg-surface-container transition-colors">
                        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active))
                            class="w-4 h-4 rounded text-primary focus:ring-0 cursor-pointer accent-primary-container mt-0.5" />
                        <div class="flex flex-col">
                            <span class="font-label-lg text-label-lg text-on-surface">Active Status</span>
                            <span class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">
                                When enabled, this product is visible in the catalog.
                            </span>
                        </div>
                    </label>

                    <div class="flex flex-col gap-space-sm pt-space-md">
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-space-xs py-space-sm px-space-md rounded-lg font-label-lg text-label-lg bg-primary-container hover:bg-primary text-on-primary shadow-sm transition-all">
                            <span class="material-symbols-outlined text-lg">check_circle</span>
                            Save Changes
                        </button>
                        <a href="{{ url()->previous() }}"
                            class="w-full inline-flex items-center justify-center py-space-sm px-space-md rounded-lg font-label-lg text-label-lg bg-surface-container text-on-surface hover:bg-surface-container-high transition-colors">
                            Cancel and Return
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection