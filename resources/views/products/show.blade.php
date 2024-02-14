
<!-- resources/views/products/show.blade.php -->
@extends('layouts.app')

@section('content')
<h1>{{ $product->name }}</h1>

<p>{{ $product->code }}</p>
<p>{{ $product->price }}</p>
<p>{{ $product->expiry_date }}</p>

<a href="{{ route('products.edit', $product) }}" class="btn btn-secondary">Edit</a>
<form action="{{ route('products.destroy', $product) }}" method="POST" style="display: inline-block">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
</form>

<a href="{{ route('products.index') }}" class="btn btn-primary">Back to all Products</a>
@endsection

