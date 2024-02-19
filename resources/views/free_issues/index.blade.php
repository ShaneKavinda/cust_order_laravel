@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Free Issues</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('free_issues.create') }}" class="btn btn-primary">Create a New Free Issue</a>
        <a href="{{ route('home') }}" class="btn btn-secondary">Home</a> <!-- Home button -->

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Purchase Product</th>
                    <th>Free Product</th>
                    <th>Purchase Quantity</th>
                    <th>Free Quantity</th>
                    <th>Lower Limit</th>
                    <th>Upper Limit</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($freeIssues as $freeIssue)
                    <tr>
                        <td>{{ $freeIssue->name }}</td>
                        <td>{{ $freeIssue->type }}</td>
                        <td>{{ $freeIssue->purchaseProduct->name }}</td>
                        <td>{{ $freeIssue->freeProduct->name }}</td>
                        <td>{{ $freeIssue->purchase_quantity }}</td>
                        <td>{{ $freeIssue->free_quantity }}</td>
                        <td>{{ $freeIssue->lower_limit }}</td>
                        <td>{{ $freeIssue->upper_limit }}</td>
                        <td>
                            <a href="{{ route('free_issues.show', $freeIssue) }}" class="btn btn-primary">View</a>
                            <a href="{{ route('free_issues.edit', $freeIssue) }}" class="btn btn-secondary">Edit</a>
                            <form action="{{ route('free_issues.destroy', $freeIssue) }}" method="POST" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                            
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
