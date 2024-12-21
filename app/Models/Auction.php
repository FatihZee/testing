<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'admin_id',
        'status',
    ];

    // Relasi ke Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relasi ke User sebagai admin
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id_user');
    }

    // Relasi ke Bid (jika ada banyak tawaran pada satu lelang)
    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function winner()
    {
        return $this->belongsTo(User::class, 'winner_id'); // Pastikan 'winner_id' digunakan sebagai foreign key
    }
}