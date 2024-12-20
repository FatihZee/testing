<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BidController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');


Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

//route auction with auth middleware

Route::get('/auctions', [AuctionController::class, 'index'])->name('auctions.index');
Route::get('/auctions/create', [AuctionController::class, 'create'])->name('auctions.create');
Route::post('/auctions', [AuctionController::class, 'store'])->name('auctions.store');
Route::get('/auctions/{auction}', [AuctionController::class, 'show'])->name('auctions.show');
Route::get('/auctions/{auction}/edit', [AuctionController::class, 'edit'])->name('auctions.edit');
Route::put('/auctions/{auction}', [AuctionController::class, 'update'])->name('auctions.update');
Route::delete('/auctions/{auction}', [AuctionController::class, 'destroy'])->name('auctions.destroy');
Route::post('auctions/{auction}/select-winner', [AuctionController::class, 'selectWinner'])->name('auctions.selectWinner');

Route::middleware('auth')->group(function () {
    Route::prefix('auctions/{auction}/bids')->group(function () {
        Route::get('/', [BidController::class, 'index'])->name('bids.index');
        Route::get('/create', [BidController::class, 'create'])->name('bids.create');
        Route::post('/', [BidController::class, 'store'])->name('bids.store');
        Route::get('/{bid}', [BidController::class, 'show'])->name('bids.show');
        Route::get('/{bid}/edit', [BidController::class, 'edit'])->name('bids.edit');
        Route::put('/{bid}', [BidController::class, 'update'])->name('bids.update');
        Route::delete('/{bid}', [BidController::class, 'destroy'])->name('bids.destroy');
        
    });
});

//dashboard
Route::get('dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');