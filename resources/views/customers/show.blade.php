
<!-- resources/views/customers/show.blade.php -->
@extends('layouts.app')

@section('content')
<h1>{{ $customer->name }}</h1>

<p>{{ $customer->code }}</p>
<p>{{ $customer->address }}</p>
<p>{{ $customer->contact }}</p>

<a href="{{ route('customers.edit', $customer) }}" class="btn btn-secondary">Edit</a>
<form action="{{ route('customers.destroy', $customer) }}" method="POST" style="display: inline-block">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
</form>

<a href="{{ route('customers.index') }}" class="btn btn-primary">Back to all Customers</a>
@endsection

