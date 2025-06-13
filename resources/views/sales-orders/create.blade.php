@extends('layouts.admin')
@section('title', 'Create Sales Order')
@section('content')

<h1 class="h3 mb-4">Create Sales Order</h1>

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form method="POST" action="{{ route('sales-orders.store') }}">
    @csrf

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $index => $product)
            <tr>
                <td>
                    {{ $product->name }} (₹{{ $product->price }})
                    <input type="hidden" name="products[{{ $index }}][id]" value="{{ $product->id }}">
                </td>
                <td>
                    <input type="number" name="products[{{ $index }}][quantity]" class="form-control" min="0" value="0">
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <button type="submit" class="btn btn-success">Place Order</button>
</form>
@endsection
