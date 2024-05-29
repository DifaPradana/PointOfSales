<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\detail_transaksi;
use App\Models\transaksi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function index()
    {

        $cartItems = detail_transaksi::whereHas('transaksi', function ($query) {
            $query->where('is_checkout', false);
        })->get();

        $totalHarga = $cartItems->sum('subtotal');

        $data = [
            'title' => 'List Cart',
            'cart' => detail_transaksi::where('is_checkout', false)->get(),
            'totalHarga' => $totalHarga,
            'transaksi' => transaksi::where('is_checkout', false)->latest()->first(),
            // 'barang' => barang::all(),
        ];
        return view('reseller.cart.cart', $data);
    }

    public function update(Request $request, $no_detail)
    {
        $detail_transaksi = detail_transaksi::find($no_detail);

        if (!$detail_transaksi) {
            return redirect()->back()->with('error', 'Detail transaksi tidak ditemukan.');
        }

        $transaksi = transaksi::find($detail_transaksi->kode_transaksi);

        if (!$transaksi) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        $barang = barang::find($detail_transaksi->kode_barang);

        if (!$barang) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }

        $detail_transaksi->kuantitas = $request->kuantitas;
        $detail_transaksi->subtotal = $barang->harga_jual * (int)$request->kuantitas;
        $detail_transaksi->save();

        $transaksi->total_bayar = 0;

        foreach ($transaksi->detail_transaksi as $detail) {
            $transaksi->total_bayar += $detail->subtotal;
        }

        $transaksi->save();

        Alert::success('Success', 'Kuantitas barang berhasil diubah.');

        return redirect()->back();
    }

    public function addToCart(Request $request, $kode_barang)
    {
        // Cari barang berdasarkan kode_barang
        $barang = Barang::find($kode_barang);

        if (!$barang) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }

        // Cari transaksi yang belum selesai (is_checkout = false)
        $transaksi = Transaksi::where('is_checkout', false)->latest()->first();

        // Jika tidak ditemukan transaksi yang belum selesai, buat transaksi baru
        if (!$transaksi) {
            $transaksi = Transaksi::create([
                'nama_pengirim' => 'Warrior Footwear',
                'alamat_pengirim' => 'Jl. Raya Kedungwuni KM 5, Kec. Kedungwuni, Kab. Pekalongan, Jawa Tengah',
                'ekspedisi' => null,
                'alamat_penerima' => null,
                'nama_penerima' => null,
                'harga_ongkir' => null,
                'total_bayar' => 0,
                'is_checkout' => false,
            ]);
        }

        $detailTransaksi = detail_transaksi::where('kode_transaksi', $transaksi->kode_transaksi)
            ->where('kode_barang', $barang->kode_barang)
            ->first();

        if ($detailTransaksi) {
            // Jika sudah ada, tambahkan kuantitas
            $detailTransaksi->kuantitas += (int)$request->kuantitas;
            $detailTransaksi->subtotal = $detailTransaksi->harga_satuan * $detailTransaksi->kuantitas;
            $detailTransaksi->save();
        } else {
            // Jika belum ada, buat detail transaksi baru
            detail_transaksi::create([
                'kode_transaksi' => $transaksi->kode_transaksi,
                'kode_barang' => $barang->kode_barang,
                'harga_satuan' => $barang->harga_jual,
                'kuantitas' => $request->kuantitas,
                'subtotal' => $barang->harga_jual * (int)$request->kuantitas,
            ]);
        }

        // Hitung total_bayar
        $totalBayar = detail_transaksi::where('kode_transaksi', $transaksi->kode_transaksi)->sum('subtotal');
        $transaksi->total_bayar = $totalBayar;
        $transaksi->save();

        Alert::success('Success', 'Barang berhasil ditambahkan ke keranjang.');

        return redirect()->back();
    }


    public function deleteFromCart($no_detail)
    {
        $detail_transaksi = detail_transaksi::find($no_detail);

        if (!$detail_transaksi) {
            return redirect()->back()->with('error', 'Detail transaksi tidak ditemukan.');
        }

        $transaksi = transaksi::find($detail_transaksi->kode_transaksi);

        if (!$transaksi) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        $transaksi->total_bayar -= $detail_transaksi->subtotal;
        $transaksi->save();

        $detail_transaksi->delete();

        Alert::success('Success', 'Barang berhasil dihapus dari keranjang.');

        return redirect()->back();
    }

    public function checkout()
    {
        $transaksi = transaksi::where('is_checkout', false)->latest()->first();

        if (!$transaksi) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        $transaksi->is_checkout = true;
        $transaksi->save();

        Alert::success('Success', 'Transaksi berhasil di checkout.');

        return redirect()->back();
    }
}
