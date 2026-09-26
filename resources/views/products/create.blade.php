@extends('layouts.app')
@section('title', 'Create Page')
@section('content')


    
    <h1> Create a product </h1>

    <form method="post" action="{{route('products.store')}}">
        @csrf
        @method('post')

        <div>
            <label>Name </label>
            <input type="text" placeholder="Name" name="name" value="{{ old('name') }}" />

            @include('layouts.product-error',['name' => 'name'] )
        </div>

        <div>
            <label>Sku </label>
            <input type="text" placeholder="Sku" name="sku" value="{{ old('sku') }}" />

            @include('layouts.product-error',['name' => 'sku'] )
        </div>

        <div>
            <label>Description </label>
            <input type="text" placeholder="Description" name="description" value="{{ old('description') }}" />

            @include('layouts.product-error',['name' => 'description'] )
        </div>

        <div>
            <label>Price </label>
            <input type="text" name="price" value="{{ old('price') }}" />

            @include('layouts.product-error',['name' => 'price'] )
        </div>

        <div>
            <label>Quantity </label>
            <input type="number" placeholder="Quantity" name="quantity" value="{{ old('quantity') }}" />

            @include('layouts.product-error', ['name' => 'quantity'])
        </div>

        <div>
            <label>Active</label>
            <input type="checkbox" name="is_active" value="1" />
        </div>

        <div>
            <input type="submit" value="Submit Your Product" />
        </div>



    </form>

    @endsection

