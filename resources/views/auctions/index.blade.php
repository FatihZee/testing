@extends(Auth::user()->role === 'admin' ? 'layouts.app' : 'layouts.member')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Products</h1>

        <!-- Button to Create Auction (Only for Admin) -->
        @if (auth()->user()->role === 'admin')
            <a href="{{ route('auctions.create') }}" class="btn btn-success mb-3">Create Auction</a>
        @endif

        <!-- Auction Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
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
                            <td>
                                @if ($auction->product->image)
                                    <img src="{{ asset('storage/' . $auction->product->image) }}" 
                                         alt="{{ $auction->product->name }}" 
                                         class="img-thumbnail" 
                                         style="width: 100px; height: auto;">
                                @else
                                    <p>No Image</p>
                                @endif
                            </td>
                            <td>{{ $auction->product->name }}</td>
                            <td>{{ $auction->admin->name }}</td>
                            <td>{{ ucfirst($auction->status) }}</td>
                            <td>
                                @if (auth()->user()->role === 'admin')
                                    <!-- Actions for Admin -->
                                    <a href="{{ route('auctions.show', $auction) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('auctions.edit', $auction) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('auctions.destroy', $auction) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                @else
                                    <!-- Actions for Members -->
                                    <a href="{{ route('bids.index', $auction) }}" class="btn btn-primary btn-sm">Bid Now</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
