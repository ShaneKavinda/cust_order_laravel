@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Order Details</div>

                    <div class="card-body">
                        <p><strong>Customer:</strong> {{ $order->customer->name }}</p>
                        <p><strong>Net Amount:</strong> {{ $order->net_amount }}</p>
                        <p><strong>Order Date:</strong> {{ $order->order_date }}</p>
                        <p><strong>Order Time:</strong> {{ $order->order_time }}</p>

                        <h4>Order Products</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderProducts as $orderProduct)
                                    <tr>
                                        <td>{{ $orderProduct->product_name }}</td>
                                        <td>{{ $orderProduct->quantity }}</td>
                                        <td>{{ $orderProduct->price }}</td>
                                        <td>{{ $orderProduct->amount }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
