<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PesananController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Pesanan',
            'transaksi' => transaksi::where('is_checkout', 1)->get(),

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

    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);
        $previousStatus = $transaksi->status;
        $transaksi->status = $request->status;
        $transaksi->save();

        // Check if the status is changed to "Pesanan Diproses"
        if ($previousStatus != 'Pesanan Diproses' && $transaksi->status == 'Pesanan Diproses') {
            // Assuming you have a relationship between Transaksi and Product
            foreach ($transaksi->detail_transaksi as $detail) {
                $barang = $detail->barang;
                $barang->stok -= $detail->kuantitas; // Adjust the quantity field as needed
                $barang->save();
            }
        }

        Alert::success('Berhasil', 'Status Pesanan Berhasil Diubah');
        return redirect()->back();
    }
}
