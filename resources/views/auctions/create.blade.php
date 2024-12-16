@extends('layouts.app')

@section('content')
    <h1>Create Auction</h1>
    
    <form action="{{ route('auctions.store') }}" method="POST">
        @csrf

        <label for="product_id">Product:</label>
        <select name="product_id" id="product_id">
            @foreach ($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>

        <label for="admin_id">Admin:</label>
        <select name="admin_id" id="admin_id">
            @foreach ($admins as $admin)
                <option value="{{ $admin->id_user }}">{{ $admin->name }}</option>
            @endforeach
        </select>

        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="open">Open</option>
            <option value="closed">Closed</option>
        </select>
        
        <button type="submit">Create</button>
    </form>
@endsection
