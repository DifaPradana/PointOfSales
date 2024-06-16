<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class User extends Authenticatable
{
    use AuthenticableTrait;

    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $fillable = [
        'nama_user',
        'email',
        'password',
        'status',
        'alamat',
        'no_hp',
        'role',
    ];
    protected $hidden = [
        'password',
    ];

    public function getAuthIdentifierName()
    {
        return 'id_user'; // Sesuaikan dengan nama kolom yang digunakan sebagai identifier
    }

    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function transaksi()
    {
        return $this->hasMany(transaksi::class, 'id_user', 'id_user');
    }

    public function detail_transaksi()
    {
        return $this->hasMany(detail_transaksi::class, 'id_user', 'id_user');
    }
}
