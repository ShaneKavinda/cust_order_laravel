<!-- resources/views/customers/edit.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Edit Customer</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('customers.update', $customer) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{$customer->name}}" required>
    </div>

    <div class="form-group">
        <label for="address">Address</label>
        <textarea name="address" id="address" class="form-control" rows="4" required>{{$customer->address}}</textarea>
    </div>

    <div class="form-group">
        <label for="contact">Contact No</label>
        <input type="text" name="contact" id="contact" class="form-control" value="{{ $customer->contact }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection

