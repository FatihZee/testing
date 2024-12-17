<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relasi dengan Auction yang dikelola oleh user (sebagai admin).
     */
    public function managedAuctions()
    {
        return $this->hasMany(Auction::class, 'admin_id');
    }

    /**
     * Relasi dengan Bid yang diajukan oleh user (sebagai peserta lelang).
     */
    public function bids()
    {
        return $this->hasMany(Bid::class, 'user_id');
    }

    /**
     * Relasi dengan Auction yang user ikuti (melalui bid).
     * Menggunakan melalui model Bid.
     */
    public function participatedAuctions()
    {
        return $this->hasManyThrough(
            Auction::class, 
            Bid::class, 
            'user_id',      // Foreign key di Bid
            'id',           // Foreign key di Auction
            'id_user',      // Local key di User
            'auction_id'    // Local key di Bid
        );
    }
}