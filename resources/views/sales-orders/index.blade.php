@extends('layouts.admin')
@section('title', 'Sales Orders')
@section('content')

<div class="d-flex justify-content-between mb-3">
    <h1 class="h3">Sales Orders</h1>
    <a href="{{ route('sales-orders.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> New Order
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Order ID</th>
            <th>User</th>
            <th>Total (₹)</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr>
            <td>#{{ $order->id }}</td>
            <td>{{ $order->user->name }}</td>
            <td>{{ $order->total }}</td>
            <td>{{ $order->created_at->format('d M Y') }}</td>
            <td>
                <a href="{{ route('sales-orders.show', $order->id) }}" class="btn btn-sm btn-info">View</a>
                <a href="{{ route('sales-orders.pdf', $order->id) }}" class="btn btn-sm btn-secondary">PDF</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
