<?php

// App\Http\Controllers\AuctionController.php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Auction;
use App\Models\Product;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
    public function index()
    {
        $auctions = Auction::with('product', 'admin')->get();
        return view('auctions.index', compact('auctions'));
    }

    public function create()
    {
        $products = Product::all(); // Ambil semua produk
        $admins = User::where('role', 'admin')->get(); // Ambil semua pengguna dengan peran admin
        return view('auctions.create', compact('products', 'admins')); // Kirim data produk dan admin ke tampilan
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'admin_id' => 'required|exists:users,id_user',
            'status' => 'required|in:open,closed',
        ]);

        // Simpan data lelang
        Auction::create([
            'product_id' => $request->product_id, // Hanya simpan product_id
            'admin_id' => $request->admin_id,     // Ambil admin_id dari input
            'status' => $request->status,
        ]);

        return redirect()->route('auctions.index')->with('success', 'Auction created successfully!');
    }

    public function show(Auction $auction)
    {
        return view('auctions.show', compact('auction'));
    }

    public function edit(Auction $auction)
    {
        $products = Product::all();
        return view('auctions.edit', compact('auction', 'products'));
    }

    public function update(Request $request, Auction $auction)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'status' => 'required|in:open,closed',
        ]);

        $auction->update([
            'product_id' => $request->product_id, // Hanya update product_id
            'status' => $request->status,
        ]);

        return redirect()->route('auctions.index')->with('success', 'Auction updated successfully!');
    }

    public function destroy(Auction $auction)
    {
        $auction->delete();
        return redirect()->route('auctions.index')->with('success', 'Auction deleted successfully!');
    }
}