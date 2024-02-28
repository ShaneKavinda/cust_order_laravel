<!-- resources/views/posts/create.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Create Discount</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('discounts.store') }}" method="POST">
    @csrf

    <label for="product">Product:</label>
    <select name="product" id="product" class="form-control">
        <option value="">Select Product</option>
        @foreach($products as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
        @endforeach
    </select>

    <div class="form-group">
        <label for="Discount">Discount</label>
        <input type="n" name="discount" id="discount" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="name">Lower limit</label>
        <input type="text" name="lower_limit" id="lower_limit" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="name">Upper Limit</label>
        <input type="text" name="upper_limit" id="upper_limit" class="form-control" required>
    </div>
    <button type="submit">Save Discount</button>
</form>

</div>
@endsection
