@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Orders</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{route('orders.create')}}" class="btn btn-primary">Create new Order</a>
        <a href="{{ route('home') }}" class="btn btn-secondary">Home</a> 
        <table class="table">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all" value=false></th>
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
                        <td><input type="checkbox" id={{$order->id}} value=false></td>
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
        <a class="btn btn-primary" id="bulk-generate">Bulk Generate Invoices</a>
    </div>

    <script>
        // ids to bulk generate invoices
        let ids = [];

        var checkboxes = document.querySelectorAll('input[type="checkbox"]:not(#select-all)');
        checkboxes.forEach(function (checkbox){
            checkbox.addEventListener('change', function(event){
                if (checkbox.checked == true){
                    ids.push(checkbox.id);
                    console.log(ids);
                }
                if (checkbox.checked == false) {
                    ids.pop(checkbox.id);
                    console.log(ids);
                }
            })
        });

        var selectAll = document.getElementById('select-all');
        selectAll.addEventListener('change', function(event){
            if (selectAll.checked == true){
                console.log('select all');
                checkboxes.forEach((checkbox)=>{
                    checkbox.checked = true;
                    ids.push(checkbox.id);
                });
            }
            if (selectAll.checked == false){
                checkboxes.forEach((checkbox)=>{
                    checkbox.checked = false;
                    ids.pop(checkbox.id);
                })
            }
            console.log(ids);
        });
    </script>
@endsection

