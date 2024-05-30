<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Pesanan',
            'transaksi' => transaksi::with(['detail_transaksi', 'bukti_pembayaran'])->where('status', 'Menunggu Verifikasi')->get(),

        ];
        return view('admin.pesanan.pesanan', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Pesanan',
            'transaksi' => transaksi::with(['detail_transaksi', 'bukti_pembayaran'])->find($id),
        ];
        return view('admin.pesanan.detail', $data);
    }
}
