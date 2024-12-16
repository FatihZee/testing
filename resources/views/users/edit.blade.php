@extends('layouts.app')

@section('content')
    <h1>Edit User</h1>
    <form action="{{ route('users.update', $user->id_user) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Name:</label>
        <input type="text" name="name" value="{{ $user->name }}" required>
        <label>Email:</label>
        <input type="email" name="email" value="{{ $user->email }}" required>
        <label>Username:</label>
        <input type="text" name="username" value="{{ $user->username }}" required>
        <label>Password:</label>
        <input type="password" name="password">
        <label>Role:</label>
        <input type="text" name="role" value="{{ $user->role }}" required>
        <button type="submit">Update</button>
    </form>
@endsection
