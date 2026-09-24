<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Product Details</h1>

<p>Name: {{ $product->name }}</p>
<p>SKU: {{ $product->sku }}</p>
<p>Description: {{ $product->description }}</p>
<p>Price: {{ $product->price }}</p>
<p>Quantity: {{ $product->quantity }}</p>
<p>Active: {{ $product->is_active ? 'Yes' : 'No' }}</p>

<a href="{{ route('products.index') }}">Back to Products</a>
</body>
</html>