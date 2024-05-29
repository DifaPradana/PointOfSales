<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_transaksi extends Model
{
    use HasFactory;

    protected $table = "detail_transaksi";

    protected $primaryKey = "no_detail";

    protected $guard = "no_detail";

    protected $foreignKey = ["kode_transaksi", "kode_barang"];

    protected $fillable = [
        'kode_transaksi',
        'kode_barang',
        'subtotal',
        'harga_satuan',
        'kuantitas',
        'is_checkout'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang', 'kode_barang');
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'kode_transaksi', 'kode_transaksi');
    }
}
