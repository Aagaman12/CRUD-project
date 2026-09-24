<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Product Index</h1>
    <div>
        @if(session()->has('success'))
            <div>
                {{  session('success')}}
            </div>

        @endif
    </div>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Sku</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantitiy</th>
            <th>Active Status</th>
            <th>Show</th>
            <th>Edit</th>
            <th>Delete</th>
            
        </tr>

        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->sku }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->is_active }}</td>

                <td>
                    <a href="{{ route('products.show', ['product' => $product])}}">Show</a>
                </td>

                <td><a href="{{ route('products.edit', ['product' => $product]) }}">Edit</a></td>
                <td>
                    <form method="post" action="{{ route('products.delete', ['product' => $product]) }}">
                        <!-- use form to delete data -->
                        @csrf
                        @method('delete')
                        <input type="submit" value="Delete" />
                    </form>
                </td>


            </tr>
        @endforeach
    </table>

    <a href="{{route('products.create')}}">CREATE A PRODUCT</a>
</body>

</html>