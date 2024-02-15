<!-- resources/views/products/index.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Products</h1>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('products.create') }}" class="btn btn-primary">Create a New Product</a>
<a href="{{ route('home') }}" class="btn btn-secondary">Home</a> <!-- Home button -->
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Code</th>
            <th>Price</th>
            <th>Expiry Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->code }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->expiry_date }}</td>
                <td>
                    <a href="{{ route('products.show', $product) }}" class="btn btn-primary">View</a>
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-secondary">Edit</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $products->links() }}
    
@endsection
