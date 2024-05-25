<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class kelolapersediaanController extends Controller
{
    public function index()
    {

        return view('admin.persediaan.input-barang');
    }

    //simpan data baru
    public function store(Request $request)
    {
        // Validasi input
        $validasi = $request->validate([
            "nama_barang" => "required|string",
            "harga" => "required|int",
            "deskripsi" => "required|string",
            "stok" => "required|int",
            "kategori" => "required|string",
            "warna" => "required|string",
            "ukuran" => "required|int",
            "gambar" => "required|file|mimes:jpg,png",
        ]);

        // Proses upload gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_barang = $request->input('nama_barang');

            // Membuat nama file baru
            $newFileName = time() . '-' . preg_replace('/\s+/', '_', $nama_barang) . '.' . $file->getClientOriginalExtension();

            // Pindahkan file ke folder 'images' di dalam 'public'
            $file->move(public_path('images'), $newFileName);

            // Tambahkan path file gambar ke array validasi
            $validasi['gambar'] = 'images/' . $newFileName;
        }

        // Simpan data barang ke database
        barang::create($validasi);

        // Menampilkan pesan sukses
        Alert::success('Sukses', 'Barang berhasil ditambahkan');

        // Arahkan kembali ke halaman sebelumnya
        return redirect()->route('admin.tabel-barang');
    }



    // mengarah ke halaman selanjutnya
    // return redirect()->route("dashboard.admin");


    //mengarah ke tampil barang
    public function tabel()
    {
        $barang = barang::all();
        return view('admin.persediaan.table-barang', compact('barang'));
    }

    public function indexupdate($id)
    {
        $barang = barang::find($id);
        return view('admin.persediaan.update', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);

        // Check if barang is found
        if (!$barang) {
            return abort(404);
        }

        $validasi = Validator::make($request->all(), [
            "nama_barang" => "required|string",
            "harga" => "required|int",
            "deskripsi" => "required|string",
            "stok" => "required|int",
            "kategori" => "required|string",
            "warna" => "required|string",
            "ukuran" => "required|int",
            "gambar" => "nullable|file|mimes:jpg,png",
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withErrors($validasi->errors())->withInput();
        }

        // Update barang properties
        $barang->nama_barang = $request->nama_barang;
        $barang->harga = $request->harga;
        $barang->deskripsi = $request->deskripsi;
        $barang->stok = $request->stok;
        $barang->kategori = $request->kategori;
        $barang->warna = $request->warna;
        $barang->ukuran = $request->ukuran;

        // Check if a new image is uploaded
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_barang = $request->input('nama_barang');

            // Membuat nama file baru
            $newFileName = time() . '-' . preg_replace('/\s+/', '_', $nama_barang) . '.' . $file->getClientOriginalExtension();

            // Pindahkan file ke folder 'images' di dalam 'public'
            $file->move(public_path('images'), $newFileName);

            // Hapus gambar lama jika ada
            if ($barang->gambar && file_exists(public_path($barang->gambar))) {
                unlink(public_path($barang->gambar));
            }

            // Tambahkan path file gambar ke array validasi
            $barang->gambar = 'images/' . $newFileName;
        }

        // Save the updated barang
        $barang->save();

        // Success message and redirect
        Alert::success('Sukses', 'Barang berhasil diubah');
        return redirect()->route("admin.tabel-barang");
    }



    public function destroy($id)
    {
        $barang = barang::find($id);
        // jika barang tidak ditemukan
        if (!$barang) {
            return abort(404);
        }
        $barang->delete();

        Alert::success('Sukses', 'barang berhasil dihapus');

        //jika tidak diarahkan pada halaman lain
        return redirect()->route("admin.tabel-barang");
    }

    public function tambahStok(Request $request)
    {
        // Validasi input
        $request->validate([
            'kode_barang' => 'required|exists:barang,kode_barang',
            'stok' => 'required|integer|min:1',
        ]);

        // Dapatkan barang berdasarkan kode_barang
        $barang = Barang::where('kode_barang', $request->kode_barang)->first();

        if (!$barang) {
            return redirect()->back()->withErrors(['error' => 'Barang tidak ditemukan.']);
        }

        // Tambahkan stok baru ke stok lama
        $barang->stok += $request->stok;

        // Simpan perubahan ke database
        $barang->save();

        // Tampilkan pesan sukses
        Alert::success('Sukses', 'Berhasil menambahkan stok barang.');
        return redirect()->back();
    }
}
