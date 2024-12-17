@extends(Auth::user()->role === 'admin' ? 'layouts.app' : 'layouts.member')

@section('content')
    <div class="container mt-4">
        <img src="{{ asset('midwest.png') }}" class="img-fluid" alt="Dashboard Image">
    </div>
@endsection
