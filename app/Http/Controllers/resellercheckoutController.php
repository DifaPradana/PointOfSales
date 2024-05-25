<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class resellercheckoutController extends Controller
{
    public function index(){
        return view('reseller.checkout.index');
    }
}
