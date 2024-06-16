<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;




class DashboardController extends Controller
{
    //
    public function admin()
    {
        Carbon::setLocale('id');

        $data = array(
            'title' => 'Admin Dashboard',
            'barang' => barang::all(),
            'order' => transaksi::where('status', 'Menunggu Verifikasi')->get(),
            'transaksi' => transaksi::where('status', "Diterima")->get(),
            'monthly_total_bayar' => transaksi::where('status', 'Diterima')
                ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                ->sum('total_bayar'),
            'current_month' => Carbon::now()->translatedFormat('F'), // Get the current month's name in Indonesian
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
