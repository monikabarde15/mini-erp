@extends('layouts.admin')
@section('title', 'Order Details')
@section('content')

<h1 class="h3 mb-4">Order #{{ $order->id }}</h1>

<p><strong>User:</strong> {{ $order->user->name }}</p>
<p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Price (₹)</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->items as $item)
        <tr>
            <td>{{ $item->product->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->price }}</td>
            <td>{{ $item->price * $item->quantity }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h4>Total: ₹{{ $order->total }}</h4>
<a href="{{ route('sales-orders.pdf', $order->id) }}" class="btn btn-secondary mt-3">Download PDF</a>
@endsection
