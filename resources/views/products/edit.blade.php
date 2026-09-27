@extends('layouts.app')
@section('title', 'Edit Page')
@section('content')

    <h1> Update a product </h1>



    <form method="post" action="{{ route('products.update', ['product' => $product]) }}" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div>
            <label>Product</label>
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" width="100" alt="{{ $product->name }}">
            @endif
            <input type="file" name="image" accept="image/*" />
            @include('layouts.product-error', ['name' => 'image'])
        </div>

        <div>
            <label>Name </label>
            <input type="text" placeholder="Name" name="name" value="{{ $product->name }}" />
            @include('layouts.product-error', ['name' => 'name'])
        </div>

        <div>
            <label>Sku </label>
            <input type="text" placeholder="Sku" name="sku" value="{{ $product->sku }}" />
            @include('layouts.product-error', ['name' => 'sku'])
        </div>

        <div>
            <label>Description </label>
            <input type="text" placeholder="Description" name="description" value="{{ $product->description }}" />
            @include('layouts.product-error', ['name' => 'description'])
        </div>

        <div>
            <label>Price </label>
            <input type="text" name="price" value="{{ $product->price }}" />
            @include('layouts.product-error', ['name' => 'price'])
        </div>

        <div>
            <label>Quantity </label>
            <input type="number" placeholder="Quantity" name="quantity" value="{{ $product->quantity }}" />
            @include('layouts.product-error', ['name' => 'quantity'])
        </div>

        <div>
            <label>Active</label>
            <input type="checkbox" name="is_active" value="1" @checked($product->is_active) /> <br>
        </div>

        <input type="submit" value="Update Your Product" />




    </form>

@endsection