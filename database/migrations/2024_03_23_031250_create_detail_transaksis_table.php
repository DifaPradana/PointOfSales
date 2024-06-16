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
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id("no_detail");

            $table->unsignedBigInteger("kode_transaksi")->nullable();
            $table->foreign("kode_transaksi")->references("kode_transaksi")->on("transaksi")->onDelete("cascade");

            $table->unsignedBigInteger("kode_barang");
            $table->foreign("kode_barang")->references("kode_barang")->on("barang")->onDelete("cascade");

            $table->unsignedBigInteger("id_user");
            $table->foreign("id_user")->references("id_user")->on("users")->onDelete("cascade");

            $table->integer("subtotal");
            $table->integer("harga_satuan");
            $table->integer("kuantitas")->default(1);


            $table->boolean("is_checkout")->default(false);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi');
    }
};
