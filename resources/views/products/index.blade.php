@extends('layouts.app')
@section('title', 'Index Page')

@section('content')

    <h1 class="text-3xl font-bold text-blue-600">Product Index</h1>

    <div>
        <a href="{{route('products.create')}}">CREATE A PRODUCT</a>
    </div>


    <div>
        @if(session()->has('success'))
            <div>
                {{  session('success')}}
            </div>

        @endif
    </div>

    <div>
        <form method="get" action="{{ route('products.index') }}">

            <input type="text" placeholder="Search for product." name="search" />
            <input type="submit" value="Search" />

            <select name="sort">
                <option value="sort" @selected(!request('sort'))>Sort By</option>
                <option value="name" @selected(request('sort') === 'name')>Name</option>
                <option value="price" @selected(request('sort') === 'price')>Price</option>
                <option value="quantity" @selected(request('sort') === 'quantity')>Quantity</option>
                <option value="created_at" @selected(request('sort') === 'created_at')>New</option>
            </select>

            <select name="direction">
                <option value="asc" @selected(request('direction') === 'asc')>Ascending</option>
                <option value="desc" @selected(request('direction') === 'desc')>Descending</option>
            </select>

            <select name="status">
                <option value="" @selected(!request('status'))>All Statuses</option>
                <option value="active" @selected(request('status') === 'active')>Active</option>
                <option value="inactive" @selected(request('status') === 'inactive')>Inactive</option>
            </select>

            <button type="submit">Apply</button>

        </form>
    </div>




    <table>
        <tr>
            <th>Id</th>
            <th>Image</th>
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
                <td>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" width="60">
                    @endif
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->sku }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->is_active ? 'Yes' : 'No' }}</td>

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


    <div>
        {{ $products->links() }} <!-- implementing pagination -->

    </div>


@endsection