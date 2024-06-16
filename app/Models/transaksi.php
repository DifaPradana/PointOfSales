<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;
    protected $table = "transaksi";
    protected $primaryKey = "kode_transaksi";
    protected $guard = "kode_transaksi";

    protected $fillable = [
        'nama_pengirim',
        'alamat_pengirim',
        'ekspedisi',
        'alamat_penerima',
        'nama_penerima',
        'harga_ongkir',
        'total_bayar',
        'status',
        'bukti_bayar',
        'id_user'
    ];

    public function detail_transaksi()
    {
        return $this->hasMany(detail_transaksi::class, 'kode_transaksi', 'kode_transaksi');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
