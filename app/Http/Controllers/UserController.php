<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified user.
     */
    public function show($id_user)
    {
        $user = User::findOrFail($id_user);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id_user)
    {
        $user = User::findOrFail($id_user);

        // Simpan URL sebelumnya ke session jika belum ada
        if (!session()->has('previous_url')) {
            session(['previous_url' => url()->previous()]);
        }

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $id_user)
    {
        $user = User::findOrFail($id_user);

        $request->validate([
            'email' => "sometimes|required|email|unique:users,email,{$id_user},id_user",
            'username' => "sometimes|required|string|max:255|unique:users,username,{$id_user},id_user",
            'username' => 'sometimes|required|string|max:255|unique:users,username,' . $id_user . ',id_user',
            'password' => 'sometimes|nullable|string|min:8',
            'role' => 'sometimes|required|string',
        ]);

        $user->update([
            'name' => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email,
            'username' => $request->username ?? $user->username,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'role' => $request->role ?? $user->role,
        ]);

        // Hapus session halaman asal
        session()->forget('previous_url');

        if (Auth::user()->role === 'admin') {
            return redirect()->route('users.index')->with('success', 'User updated successfully.');
        } else {
            return redirect()->route('dashboard')->with('success', 'Profile updated successfully.');
        }
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy($id_user)
    {
        $user = User::findOrFail($id_user);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}