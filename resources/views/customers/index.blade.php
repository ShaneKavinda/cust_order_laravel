<!-- resources/views/customers/index.blade.php -->
@extends('layouts.app')

@section('content')
<h1>All Customers</h1>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('customers.create') }}" class="btn btn-primary">Create a New Customer</a>
<a href="{{ route('home') }}" class="btn btn-secondary">Home</a> <!-- Home button -->
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Code</th>
            <th>Address</th>
            <th>Contact</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $customer)
            <tr>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->code }}</td>
                <td>{{ $customer->address }}</td>
                <td>{{ $customer->contact }}</td>
                <td>
                    <a href="{{ route('customers.show', $customer) }}" class="btn btn-primary">View</a>
                    <a href="{{ route('customers.edit', $customer) }}" class="btn btn-secondary">Edit</a>
                    <form action="{{ route('customers.destroy', $customer) }}" method="POST" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $customers->links() }}
@endsection

