<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use illuminate\Foundation\Auth\admin as Authenticatable;

class admin extends Model
{
    use HasFactory;

    //menentukan nama tabel
    protected $table = "admin";

    //menentukan primary key
    protected $primaryKey = "id_admin";

    //melindungi agar kolom tidak bisa diisi
    protected $guard = "id_admin";

    //untuk menyembunyikan kolom
    protected $hidden = "kata_sandi_admin";

    public static function attemptLogin($email, $kata_sandi_admin)
    {
        $admin = self::where("email", $email)->first();

        if ($admin && Hash::check($kata_sandi_admin, $admin->kata_sandi_admin)) {
            return $admin;
        }
        return null;
    }
}
