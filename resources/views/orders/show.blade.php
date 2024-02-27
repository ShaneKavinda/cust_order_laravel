@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Order Details</div>
                    <a href="{{ route('orders.pdf.download', $order) }}" class="btn btn-primary">Print to PDF</a>
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
                                @foreach ($order->products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->pivot->quantity }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->pivot->amount }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{route('orders.index')}}" class="button btn-primary">Go Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
