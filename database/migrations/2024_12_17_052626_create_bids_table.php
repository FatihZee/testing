<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidsTable extends Migration
{
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('auction_id');
            $table->unsignedBigInteger('user_id'); // Tetap gunakan ini untuk foreign key
            $table->decimal('bid_price', 10, 2);
            $table->timestamp('bid_time');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('auction_id')->references('id')->on('auctions')->onDelete('cascade');
            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade'); // Pastikan ini mengacu ke `id_user`
        });
    }

    public function down()
    {
        Schema::dropIfExists('bids');
    }
}