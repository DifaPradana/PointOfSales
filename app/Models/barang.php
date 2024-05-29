<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;

    protected $table = "barang";

    protected $primaryKey = "kode_barang";

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kode_brand',
        'harga_beli',
        'harga_jual',
        'tipe',
        'stok',
        'deskripsi',
        'warna',
        'ukuran',
        'gambar'
    ];


    public function brand()
    {
        return $this->belongsTo(Brand::class, 'kode_brand', 'kode_brand');
    }

    public function detail_transaksi()
    {
        return $this->hasMany(detail_transaksi::class, 'kode_barang', 'kode_barang');
    }
}
