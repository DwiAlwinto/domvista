<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AdminAuthController extends Controller
{
    //
    function index()
    {
        return view('admin.auth.login');
    }

    function doLogin(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // Coba melakukan autentikasi
        if (Auth::attempt($data)) {
            // Alert::success('Wellcome in WIINEX');
            // Jika berhasil, redirect ke dashboard admin
            return redirect()->intended('/admin/dashboard');
        }
        // Jika gagal, kembali ke halaman login dengan pesan error
        return back()->with('loginError', 'Email or Password wrong');
    }

    function logout(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('login');
    }
}
