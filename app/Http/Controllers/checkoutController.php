<?php

namespace App\Http\Controllers;

use App\Models\detail_transaksi;
use App\Models\transaksi;
use Illuminate\Http\Request;

class checkoutController extends Controller
{
    public function index($id)
    {
        $data = [
            'title' => 'Checkout',
            'transaksi' => transaksi::find($id),
        ];
        return view('reseller.checkout.checkout', $data);
    }

    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        $transaksi->nama_penerima = $request->nama_penerima;
        $transaksi->alamat_penerima = $request->alamat_penerima;
        $transaksi->ekspedisi = $request->ekspedisi;
        $transaksi->harga_ongkir = $request->harga_ongkir;
        $transaksi->is_checkout = true;
        $transaksi->save();

        // Perbarui is_checkout pada detail_transaksi yang terkait
        detail_transaksi::where('kode_transaksi', $transaksi->kode_transaksi)
            ->update(['is_checkout' => 1]);

        return redirect()->route('reseller.cart')->with('success', 'Transaksi berhasil di checkout.');
    }
}
