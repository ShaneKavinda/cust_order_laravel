{{-- resources\views\discounts\index.blade.php --}}
@extends('layouts.app')

@section('content')
<h1>All Discounts</h1>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('discounts.create') }}" class="btn btn-primary">Add new Discount</a>
<a href="{{ route('home') }}" class="btn btn-secondary">Home</a> <!-- Home button -->
<table class="table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Discount</th>
            <th>Lower Limit</th>
            <th>Upper Limit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($discounts as $discount)
            <tr>
                <td>{{ $discount->product->name }}</td>
                <td>{{ $discount->discount }}</td>
                <td>{{ $discount->lower_limit }}</td>
                <td>{{ $discount->upper_limit }}</td>
                <td>
                    <a href="{{ route('discounts.edit', $discount) }}" class="btn btn-secondary">Edit</a>
                    <form action="{{ route('discounts.destroy', $discount) }}" method="POST" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection

