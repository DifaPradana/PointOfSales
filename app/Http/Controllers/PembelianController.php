<?php

namespace App\Http\Controllers;

use App\Models\bukti_pembayaran;
use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PembelianController extends Controller
{
    public function index()
    {
        $data = [
            $userId = Auth::id(),
            'title' => 'Pembelian',
            'transaksi' => Transaksi::where('is_checkout', 1)
                ->where('id_user', $userId) // Filter berdasarkan id_user
                ->get(),
        ];
        return view('reseller.pembelian.pembelian', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Pembelian',
            'transaksi' => transaksi::find($id),
        ];
        return view('reseller.pembelian.detail', $data);
    }

    // public function store(Request $request, $kode_transaksi)
    // {
    //     $request->validate([
    //         'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
    //     ]);

    //     $transaksi = transaksi::find($kode_transaksi);

    //     if (!$transaksi) {
    //         return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
    //     }

    //     if ($request->hasFile('bukti_pembayaran')) {
    //         $file = $request->file('bukti_pembayaran');

    //         // Membuat nama file baru
    //         $newFileName = time() . '-' . preg_replace('/\s+/', '_', $id) . '.' . $file->getClientOriginalExtension();

    //         // Pindahkan file ke folder 'images' di dalam 'public'
    //         $file->move(public_path('image_bukti_pembayaran'), $newFileName);

    //         // Tambahkan path file gambar ke array validasi
    //         $validasi['bukti_pembayaran'] = 'image_bukti_pembayaran/' . $newFileName;
    //     }

    //     bukti_pembayaran::create([
    //         'kode_transaksi' => $transaksi->kode_transaksi,
    //         'bukti_bayar' => $path,
    //     ]);

    //     return redirect()->route('reseller.pembelian.pembelian');
    // }

    public function uploadBuktiBayar(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'bukti_bayar' => 'required|mimes:jpg,jpeg,png|max:2048', // Adjust file type and size as needed
        ]);

        // Find the transaksi by id
        $transaksi = Transaksi::findOrFail($id);

        // Handle the file upload
        if ($request->hasFile('bukti_bayar')) {
            // Get the uploaded file
            $file = $request->file('bukti_bayar');

            // Define a unique file name
            $newFileName = time() . '_' . $file->getClientOriginalName();

            // Move the file to the bukti_bayar folder in the public directory
            $file->move(public_path('bukti_bayar'), $newFileName);

            // Update the bukti_bayar field in the database
            $transaksi->bukti_bayar = 'bukti_bayar/' . $newFileName;
            $transaksi->status = 'Menunggu Verifikasi'; // Update status to waiting for verification
            $transaksi->save();

            Alert::success('Success', 'Bukti bayar berhasil diupload');
            return redirect()->route('reseller.pembelian');
        }

        Alert::error('Error', 'Gagal mengupload bukti bayar');
        return redirect()->route('reseller.pembelian');
    }

    public function updateStatusDiterima($id)
    {
        $transaksi = transaksi::find($id);
        $transaksi->status = 'Diterima';
        $transaksi->save();

        return redirect()->route('reseller.pembelian');
    }



    public function destroy($id)
    {
        $transaksi = transaksi::find($id);
        $transaksi->delete();

        return redirect()->route('reseller.pembelian');
    }
}
