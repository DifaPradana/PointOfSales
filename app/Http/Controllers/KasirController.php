<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\detail_transaksi;
use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class KasirController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $cartItems = detail_transaksi::whereHas('transaksi', function ($query) use ($userId) {
            $query->where('is_checkout', false)
                ->where('id_user', $userId);
        })->get();

        $totalHarga = $cartItems->sum('subtotal');

        $data = [
            'title' => 'List Cart',
            'cart' => $cartItems,
            'totalHarga' => $totalHarga,
            'transaksi' => Transaksi::where('is_checkout', false)
                ->where('id_user', $userId) // Filter berdasarkan id_user
                ->latest()
                ->first(),
            'barang' => barang::all()
        ];

        return view('admin.kasir.kasir', $data);
    }

    public function addToCart(Request $request)
    {
        $userId = Auth::id(); // Mendapatkan ID user yang sedang login

        // Validasi input form
        $request->validate([
            'kode_barang' => 'required|exists:barang,kode_barang',
        ]);

        // Cari barang berdasarkan kode_barang
        $barang = Barang::find($request->kode_barang);

        if (!$barang) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }

        // Cari transaksi yang belum selesai (is_checkout = false)
        $transaksi = Transaksi::where('is_checkout', false)->where('id_user', $userId)->latest()->first();

        // Jika tidak ditemukan transaksi yang belum selesai, buat transaksi baru
        if (!$transaksi) {
            $transaksi = Transaksi::create([
                'id_user' => $userId,
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
                'id_user' => $userId,
            ]);
        }

        // Hitung total_bayar
        $totalBayar = detail_transaksi::where('kode_transaksi', $transaksi->kode_transaksi)->sum('subtotal');
        $transaksi->total_bayar = $totalBayar;
        $transaksi->save();

        Alert::success('Success', 'Barang berhasil ditambahkan ke keranjang.');

        return redirect()->back();
    }
}
