<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;

class ResellerProdukController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Reseller Produk',
            'barang' => barang::all()
        );
        return view('reseller.produk.produk', $data);
    }
}
