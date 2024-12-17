<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\User;
use App\Models\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    // Menampilkan daftar bid untuk user yang login pada auction tertentu
    public function index($auctionId)
    {
        $auction = Auction::with('product')->findOrFail($auctionId);
        $user = User::find(Auth::id());

        // Ambil semua bids dari auction ini
        $bids = Bid::where('auction_id', $auctionId)
                    ->where('user_id', Auth::id())  // Hanya menampilkan bid yang dimiliki oleh user yang sedang login
                    ->orderBy('bid_price', 'desc')
                    ->get();

        // Ambil harga bid tertinggi dari semua user (bukan hanya milik user yang sedang login)
        $highestBid = Bid::where('auction_id', $auctionId)
                        ->max('bid_price');

        return view('bids.index', compact('auction', 'bids', 'highestBid'));
    }

    // Form untuk menambahkan bid baru
    public function create($auctionId)
    {
        $auction = Auction::with('product')->findOrFail($auctionId);
        return view('bids.create', compact('auction'));
    }

    // Menyimpan bid baru
    public function store(Request $request, $auctionId)
    {
        $auction = Auction::with('product')->findOrFail($auctionId);

        // Ambil bid tertinggi saat ini
        $highestBid = Bid::where('auction_id', $auctionId)->max('bid_price');
        $minimumBid = max($highestBid + 1, $auction->product->price + 1);

        $request->validate([
            'bid_price' => 'required|numeric|min:' . $minimumBid,
        ]);

        Bid::create([
            'auction_id' => $auctionId,
            'user_id' => Auth::id(),
            'bid_price' => $request->bid_price,
            'bid_time' => now(),
        ]);

        return redirect()->route('bids.index', $auctionId)->with('success', 'Bid placed successfully.');
    }

    // Menampilkan detail bid
    public function show($auctionId, $bidId)
    {
        $auction = Auction::findOrFail($auctionId);
        $bid = Bid::where('id', $bidId)->where('auction_id', $auctionId)->firstOrFail();

        return view('bids.show', compact('bid', 'auction'));
    }

    // Form untuk edit bid
    public function edit($auctionId, $bidId)
    {
        $auction = Auction::findOrFail($auctionId);
        $bid = Bid::where('id', $bidId)
                    ->where('auction_id', $auctionId)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        return view('bids.edit', compact('auction', 'bid'));
    }

    // Mengupdate bid
    public function update(Request $request, $auctionId, $bidId)
    {
        $auction = Auction::findOrFail($auctionId);
        $bid = Bid::where('id', $bidId)
                    ->where('auction_id', $auctionId)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        $highestBid = Bid::where('auction_id', $auctionId)->max('bid_price');
        $minimumBid = max($highestBid + 1, $auction->product->price + 1);

        $request->validate([
            'bid_price' => 'required|numeric|min:' . $minimumBid,
        ]);

        $bid->update(['bid_price' => $request->bid_price]);

        return redirect()->route('bids.index', $auctionId)->with('success', 'Bid updated successfully.');
    }

    // Menghapus bid
    public function destroy($auctionId, $bidId)
    {
        $bid = Bid::where('id', $bidId)
                    ->where('auction_id', $auctionId)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        $bid->delete();

        return redirect()->route('bids.index', $auctionId)->with('success', 'Bid deleted successfully.');
    }

    
}