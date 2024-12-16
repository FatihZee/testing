@extends('layouts.view')

@section('content')
    <div class="container d-flex justify-content-center align-items-center vh-100" style="font-family: 'Poppins', sans-serif;">
        <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
            <h1 class="text-center mb-4">Login</h1>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ url('login') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group mb-4">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>

            <p class="text-center mt-3">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
        </div>
    </div>
@endsection



