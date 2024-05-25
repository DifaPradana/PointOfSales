<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class ResellerController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Admin - Reseller',
            'reseller' => User::where('role', 'reseller')->get()
        ];
        return view('admin.reseller.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_reseller' => 'required',
            'kata_sandi_reseller' => 'required',
            'alamat' => 'required',
            'is_confirmed' => 'required'
        ]);

        User::create($request->all());
        return redirect()->route('reseller.dashboard')->with('success', 'Reseller Created Successfully');
    }

    public function update_status($id)
    {
        $reseller = User::find($id);
        $reseller->is_confirmed = !$reseller->is_confirmed;
        $reseller->save();
        return redirect()->route('reseller.dashboard')->with('success', 'Reseller Status Updated Successfully');
    }
}
