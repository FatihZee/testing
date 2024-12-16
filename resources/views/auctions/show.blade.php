@extends('layouts.app')
@section('content')
    <h1>Auction Details</h1>
    <p><strong>ID:</strong> {{ $auction->id }}</p>
    <p><strong>Product Name:</strong> {{ $auction->product_name }}</p>
    <p><strong>Status:</strong> {{ $auction->status }}</p>
    <p><strong>Created At:</strong> {{ $auction->created_at }}</p>
    <p><strong>Updated At:</strong> {{ $auction->updated_at }}</p>

    <a href="{{ route('auctions.edit', $auction) }}">Edit</a>
    <form action="{{ route('auctions.destroy', $auction) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
    <a href="{{ route('auctions.index') }}">Back to List</a>
@endsection
