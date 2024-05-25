<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bukti_pembayaran', function (Blueprint $table) {
            $table->id("kode_bukti");
            $table->string("bukti_bayar");
            $table->unsignedBigInteger("kode_transaksi");

            $table->foreign("kode_transaksi")->references("kode_transaksi")->on("transaksi")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukti_pembayaran');
    }
};
