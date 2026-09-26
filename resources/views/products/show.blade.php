@extends('layouts.app')
@section('title', 'Show Products')
@section('content')

    <h1>Product Details</h1>
   

<p>Name: {{ $product->name }}</p>
<p>SKU: {{ $product->sku }}</p>
<p>Description: {{ $product->description }}</p>
<p>Price: {{ $product->price }}</p>
<p>Quantity: {{ $product->quantity }}</p>
<p>Active: {{ $product->is_active ? 'Yes' : 'No' }}</p>


@endsection