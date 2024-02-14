@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create FreeIssue</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('free_issues.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-control" required>
                    <option value="flat">Flat</option>
                    <option value="multiple">Multiple</option>
                </select>
            </div>
            <div class="form-group">
                <label for="purchase_product">Purchase Product</label>
                <select name="purchase_product" id="purchase_product" class="form-control" required>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="free_product">Free Product</label>
                <input type="text" name="free_product" id="free_product" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="purchase_quantity">Purchase Quantity</label>
                <input type="number" name="purchase_quantity" id="purchase_quantity" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="free_quantity">Free Quantity</label>
                <input type="number" name="free_quantity" id="free_quantity" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="lower_limit">Lower Limit</label>
                <input type="number" name="lower_limit" id="lower_limit" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="upper_limit">Upper Limit</label>
                <input type="number" name="upper_limit" id="upper_limit" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
