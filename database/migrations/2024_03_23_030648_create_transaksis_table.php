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
            $table->string("nama_pengirim")->default("Warrior Footwear");
            $table->string("alamat_pengirim")->default("Jl. Raya Kedungwuni KM 5, Kec. Kedungwuni, Kab. Pekalongan, Jawa Tengah");
            $table->enum("ekspedisi", ["jnt", "jne", "lion_parcel"])->nullable();
            $table->string("alamat_penerima")->nullable();
            $table->string("nama_penerima")->nullable();
            $table->integer('harga_ongkir')->nullable();
            $table->integer("total_bayar")->nullable();
            $table->boolean("is_checkout")->default(false);
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
