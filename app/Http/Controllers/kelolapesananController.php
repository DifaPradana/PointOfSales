<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class kelolapesananController extends Controller
{
    public function index(){
        return view('admin.pesanan.index');
    }
}
