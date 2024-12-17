@extends(Auth::user()->role === 'admin' ? 'layouts.app' : 'layouts.member')
@section('content')
    <h1>Auction Details</h1>

    <!-- Display Auction Details -->
    <p><strong>ID:</strong> {{ $auction->id }}</p>
    <p><strong>Product Name:</strong> {{ $auction->product->name }}</p>
    <p><strong>Status:</strong> {{ ucfirst($auction->status) }}</p>
    <p><strong>Created At:</strong> {{ $auction->created_at->format('d M Y H:i') }}</p>
    <p><strong>Updated At:</strong> {{ $auction->updated_at->format('d M Y H:i') }}</p>

    <!-- Display Product Image -->
    <div style="margin: 20px 0; display: flex; justify-content: center;">
        <img src="{{ asset('storage/' . ($auction->product->image ?? 'default.jpg')) }}" 
             alt="{{ $auction->product->name }}" 
             style="width: 300px; height: auto; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
    </div>

    <!-- Action Buttons -->
    <a href="{{ route('auctions.edit', $auction) }}" class="btn btn-primary btn-sm">Edit</a>
    <form action="{{ route('auctions.destroy', $auction) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
    </form>
    <a href="{{ route('auctions.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
@endsection
