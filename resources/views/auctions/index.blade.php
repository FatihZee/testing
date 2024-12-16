@extends('layouts.app')
@section('content')
    <h1>Auctions</h1>
    <a href="{{ route('auctions.create') }}">Create Auction</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Admin Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($auctions as $auction)
                <tr>
                    <td>{{ $auction->id }}</td>
                    <td>{{ $auction->product->name }}</td>
                    <td>{{ $auction->admin->name }}</td>
                    <td>{{ ucfirst($auction->status) }}</td> <!-- Capitalize status -->
                    <td>
                        <a href="{{ route('auctions.show', $auction) }}">View</a>
                        <a href="{{ route('auctions.edit', $auction) }}">Edit</a>
                        <form action="{{ route('auctions.destroy', $auction) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
