@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Orders</h5>
                        <p class="card-text">Manage orders</p>
                        <a href="{{ route('orders.index') }}" class="btn btn-primary">Go to Orders</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Customers</h5>
                        <p class="card-text">Manage customers</p>
                        <a href="{{ route('customers.index') }}" class="btn btn-primary">Go to Customers</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Products</h5>
                        <p class="card-text">Manage products</p>
                        <a href="{{ route('products.index') }}" class="btn btn-primary">Go to Products</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Free Issues</h5>
                        <p class="card-text">Manage free issues</p>
                        <a href="{{ route('free_issues.index') }}" class="btn btn-primary">Go to Free Issues</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Discounts</h5>
                        <p class="card-text">Manage Discounts</p>
                        <a href="{{ route('discounts.index') }}" class="btn btn-primary">Go to Discounts</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
