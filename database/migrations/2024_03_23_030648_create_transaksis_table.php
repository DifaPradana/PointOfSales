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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id("kode_transaksi");
            $table->string("nama_pengirim");
            $table->string("alamat_pengirim");
            $table->date("tanggal_transaksi");
            $table->integer("total_bayar");
            $table->enum("ekspedisi",["jnt","jne","lion_parcel"]);
            $table->string("alamat_penerima");
            $table->string("nama_penerima");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
