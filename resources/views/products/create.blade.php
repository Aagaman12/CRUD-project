<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1> Create a product </h1>

    <form method="post" action="{{route('products.store')}}">
        @csrf
        @method('post')

        <div>
            <label>Name </label>
            <input type="text" placeholder="Name" name="name" value="{{ old('name') }}" />

            @error('name')
    <span>{{ $message }}</span>
@enderror
        </div>

        <div>
            <label>Sku </label>
            <input type="text" placeholder="Sku" name="sku" value="{{ old('sku') }}" />

            @error('sku')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label>Description </label>
            <input type="text" placeholder="Description" name="description" value="{{ old('description') }}" />

            @error('description')
            <span>{{ $message }} </span>
            @enderror
        </div>

        <div>
            <label>Price </label>
            <input type="text" name="price" value="{{ old('price') }}"/>

            @error('price')
            <span>{{ $message }} </span>
            @enderror
        </div>

        <div>
            <label>Quantity </label>
            <input type="number" placeholder="Quantity" name="quantity" value="{{ old('quantity') }}"/> 

            @error('quantity')
            <span>{{ $message }} </span>
            @enderror
        </div>

        <div>
            <label>Active</label>
            <input type="checkbox" name="is_active" value="1" />
        </div>

        <div>
            <input type="submit" value="Submit Your Product" />
        </div>



    </form>
</body>

</html>