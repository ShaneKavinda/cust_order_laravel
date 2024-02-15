@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Orders</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{route('orders.create')}}" class="button btn-primary">Create new Order</a>
        <a href="{{ route('home') }}" class="btn btn-secondary">Home</a> <!-- Home button -->
        <table class="table">
            <thead>
                <tr>
                    <th>Order Number</th>
                    <th>Customer</th>
                    <th>Order Date</th>
                    <th>Order Time</th>
                    <th>Net Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->customer->name }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>{{ $order->order_time }}</td>
                        <td>{{ $order->net_amount }}</td>
                        <td>
                            <a href="{{ route('orders.show', $order) }}" class="btn btn-primary">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
