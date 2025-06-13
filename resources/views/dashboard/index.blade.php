@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<h1 class="mb-4">Dashboard</h1>

<div class="row">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">Total Sales: ₹{{ $totalSales }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">Total Orders: {{ $totalOrders }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-warning mb-3">
            <div class="card-body">
                Low Stock:
                <ul>
                    @foreach ($lowStock as $item)
                        <li>{{ $item->name }} ({{ $item->quantity }})</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
