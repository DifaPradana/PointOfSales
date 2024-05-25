<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard')->withInput(['email' => $request->input('email')]);
            } elseif ($user->role == 'reseller') {
                return redirect()->route('reseller.dashboard')->withInput(['email' => $request->input('email')]);
            } else {
                Auth::logout();
                return redirect()->route('login')->with('error', 'You do not have the required access');
            }
        } else {
            return redirect()->back()->with('error', 'Email or password is incorrect');
        }
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_user' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $reseller = User::create([
            'nama_user' => $request->input('nama_user'),
            'password' => Hash::make($request->input('password')),
            'email' => $request->input('email'),
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp'),
            'role' => 'reseller',

        ]);

        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }
}
