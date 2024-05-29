<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class ResellerController extends Controller
{
    public function index()
    {
        $data = [
            'reseller' => User::where('role', 'reseller')->get(),
            'title' => 'List Reseller'
        ];
        return view('admin.reseller.index', $data);
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'nama_reseller' => 'required',
    //         'kata_sandi_reseller' => 'required',
    //         'alamat' => 'required',
    //         'is_confirmed' => 'required'
    //     ]);

    //     User::create($request->all());
    //     return redirect()->route('admin.reseller-view')->with('success', 'Reseller Created Successfully');
    // }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu Konfirmasi,Banned,Aktif',
        ]);

        $reseller = User::find($id);

        if (!$reseller) {
            return redirect()->route('admin.reseller-view')->with('error', 'Reseller not found.');
        }

        $reseller->status = $request->status;
        $reseller->save();

        return redirect()->route('admin.reseller-view')->with('success', 'Reseller Status Updated Successfully');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('admin.reseller-view')->with('success', 'Reseller Deleted Successfully');
    }
}
