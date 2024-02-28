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

<form action="{{ route('discounts.update', $discount) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="product">Product:</label>
    <select name="product" id="product" class="form-control" required>
        @foreach($products as $product)
            <option value="{{ $product->id }}" {{ $discount->product->id == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
        @endforeach
    </select>

    <div class="form-group">
        <label for="Discount">Discount</label>
        <input type="n" name="discount" id="discount" class="form-control" value="{{$discount->discount}}" required>
    </div>
    <div class="form-group">
        <label for="name">Lower limit</label>
        <input type="text" name="lower_limit" id="lower_limit" class="form-control" value="{{$discount->lower_limit}}" required>
    </div>
    <div class="form-group">
        <label for="name">Upper Limit</label>
        <input type="text" name="upper_limit" id="upper_limit" class="form-control" value="{{$discount->upper_limit}}" required>
    </div>
    <button type="submit">Update Discount</button>
</form>

</div>
@endsection
