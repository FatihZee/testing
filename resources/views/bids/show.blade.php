@extends(Auth::user()->role === 'admin' ? 'layouts.app' : 'layouts.member')

@section('content')
    <h1>Bid Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $auction->product->name }}</h5>
            <p><strong>Bid Price:</strong> ${{ number_format($bid->bid_price, 2) }}</p>
            <p><strong>Bid Time:</strong> {{ $bid->bid_time }}</p>
        </div>
    </div>

    <a href="{{ route('bids.index', $auction->id) }}" class="btn btn-secondary mt-3">Back to Bids</a>
@endsection
