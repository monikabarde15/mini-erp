@extends('layouts.admin')
@section('title', 'Add Product')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Add New Product</h6>
    </div>
    <div class="card-body">
        {{-- Fix: Pass empty $product --}}
        <form method="POST" action="{{ route('products.store') }}">
            @csrf
            @include('products.form', ['product' => null])
            <button type="submit" class="btn btn-success">Save Product</button>
        </form>
    </div>
</div>
@endsection
