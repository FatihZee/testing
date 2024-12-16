@extends('layouts.app')
@section('content')
    <h1>Edit Auction</h1>
    <form action="{{ route('auctions.update', $auction) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="product_id">Product:</label>
        <select name="product_id" id="product_id">
            @foreach ($products as $product)
                <option value="{{ $product->id }}" {{ $product->id == $auction->product_id ? 'selected' : '' }}>
                    {{ $product->name }}
                </option>
            @endforeach
        </select>

        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="open" {{ $auction->status == 'open' ? 'selected' : '' }}>Open</option>
            <option value="closed" {{ $auction->status == 'closed' ? 'selected' : '' }}>Closed</option>
        </select>

        <button type="submit">Update</button>
    </form>
@endsection
