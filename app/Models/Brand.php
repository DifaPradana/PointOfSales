<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brand';
    protected $primaryKey = 'kode_brand';
    protected $fillable = ['nama_brand'];

    public function barang()
    {
        return $this->hasMany(Barang::class, 'kode_brand', 'kode_brand');
    }
}
