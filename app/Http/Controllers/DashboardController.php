<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function admin()
    {
        $data = array(
            'title' => 'Admin Dashboard',
            'barang' => barang::all(),
            'reseller' => User::where('role', 'reseller')->where('status', 'Aktif')->get()
        );
        return view('admin.dashboard', $data);
    }

    public function reseller()
    {
        $data = array(
            'title' => 'Reseller Dashboard',
            'barang' => barang::all()
        );
        return view('reseller.dashboard.dashboard', $data);
    }
}
