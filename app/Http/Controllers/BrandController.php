<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BrandController extends Controller
{
    public function index()
    {
        $data = [
            'brand' => Brand::all(),
            'title' => 'List Brand'
        ];

        return view('admin.persediaan.brand', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_brand' => 'required'
        ]);

        $existingBrand = Brand::where('nama_brand', $request->nama_brand)->first();

        if ($existingBrand) {
            Alert::error('Error', 'Nama brand sudah ada');
            return redirect()->back();
        } else {
            Brand::create($request->all());
            Alert::success('Sukses', 'Barang berhasil ditambahkan');
            return redirect()->route('admin.brand-view');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_brand' => 'required'
        ]);

        $brand = Brand::find($id);
        $brand->update($request->all());
        Alert::success('Sukses', 'Barang berhasil diubah');
        return redirect()->route('admin.brand-view');
    }

    public function destroy($id)
    {
        Brand::destroy($id);
        Alert::success('Sukses', 'Barang berhasil dihapus');
        return redirect()->route('admin.brand-view');
    }
}
