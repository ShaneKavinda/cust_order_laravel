<!-- resources/views/posts/create.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Create Customer</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('customers.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="address">Address</label>
        <textarea name="address" id="address" class="form-control" rows="4"  required></textarea>
    </div>

    <div class="form-group">
        <label for="contact">Contact No</label>
        <input type="text" name="contact" id="contact" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Create</button>
</form>


<a href="{{ route('customers.index') }}" class="btn btn-primary">Back to all Customers</a>
@endsection

