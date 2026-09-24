<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1> Update a product </h1>
    <div>
        @if($errors->any())
            <ul>
                @foreach($errors->all() as $error) <!-- checks for errors if the product doesnt get stored in database -->
                    <li>
                        {{$error}}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
    <form method="post" action="{{ route('products.update', ['product' => $product] ) }}">
        @csrf
        @method('put')

        <label>Name </label>
        <input type="text" placeholder="Name" name="name" value="{{ $product->name }}" /> <br>

        <label>Sku </label>
        <input type="text" placeholder="Sku" name="sku" value="{{ $product->sku }}" /> <br>

        <label>Description </label>
        <input type="text" placeholder="Description" name="description" value="{{ $product->description }}" /> <br>

        <label>Price </label>
        <input type="text" name="price" value="{{ $product->price }}" /> <br>

        <label>Quantity </label>
        <input type="number" placeholder="Quantity" name="quantity" value="{{ $product->quantity }}" /> <br>

        <label>Active</label>
        <input type="checkbox" name="is_active" value="1" {{ $product->is_active ? 'checked' : '' }}> <br>

        <input type="submit" value="Update Your Product" />




    </form>
</body>

</html>