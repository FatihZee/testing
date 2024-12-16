@extends('layouts.app')

@section('title', 'Product Details')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Product Details</h1>

        <div class="card">
            <div class="card-body">
                <p><strong>Name:</strong> {{ $product->name }}</p>
                <p><strong>Description:</strong> {{ $product->description }}</p>
                <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                <p><strong>Stock:</strong> {{ $product->stock }}</p>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('products.index') }}" class="btn btn-primary">Back to Product List</a>
        </div>
    </div>
@endsection
