<!-- resources/views/free_issues/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Free Issue</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('free_issues.update', $freeIssue) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{$freeIssue->name}}" required>
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-control" required>
                    <option value="flat" {{ $freeIssue->type == 'flat' ? 'selected' : '' }}>Flat</option>
                    <option value="multiple" {{ $freeIssue->type == 'multiple' ? 'selected' : '' }}>Multiple</option>
                </select>
            </div>
            <div class="form-group">
                <label for="purchase_product">Purchase Product</label>
                <select name="purchase_product" id="purchase_product" class="form-control" required>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $freeIssue->purchase_product == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="free_product">Free Product</label>
                <input type="text" name="free_product" id="free_product" class="form-control" value="{{$freeIssue->free_product}}"readonly>
            </div>
            <div class="form-group">
                <label for="purchase_quantity">Purchase Quantity</label>
                <input type="number" name="purchase_quantity" id="purchase_quantity" class="form-control" value="{{$freeIssue->purchase_quantity}}" required>
            </div>
            <div class="form-group">
                <label for="free_quantity">Free Quantity</label>
                <input type="number" name="free_quantity" id="free_quantity" class="form-control" value="{{$freeIssue->free_quantity}}" required>
            </div>
            <div class="form-group">
                <label for="lower_limit">Lower Limit</label>
                <input type="number" name="lower_limit" id="lower_limit" class="form-control" value="{{$freeIssue->lower_limit}}" required>
            </div>
            <div class="form-group">
                <label for="upper_limit">Upper Limit</label>
                <input type="number" name="upper_limit" id="upper_limit" class="form-control" value="{{$freeIssue->upper_limit}}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
