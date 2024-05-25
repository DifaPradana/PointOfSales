<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bukti_pembayaran extends Model
{
    use HasFactory;
    protected $table = "bukti_pembayaran";
    protected $primaryKey = "kode_bukti";
    protected $guard= "kode_bukti";

}
