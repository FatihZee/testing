<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateEnumStatusOnAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Mengubah ENUM pada kolom 'status'
        DB::statement("ALTER TABLE auctions MODIFY COLUMN status ENUM('open', 'closed', 'completed', 'pending') NOT NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Jika rollback, kembalikan status ke ENUM semula
        DB::statement("ALTER TABLE auctions MODIFY COLUMN status ENUM('open', 'closed') NOT NULL");
    }
}