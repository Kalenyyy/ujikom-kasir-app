<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginAuth(Request $request)
    {
        //validasi
        $request->validate([
            'email' => 'required|email',  // Tambahkan validasi email
            'password' => 'required',
        ]);

        // Ambil email dan password dari request
        $credentials = $request->only(['email', 'password']);

        // Cek apakah kredensial benar
        if (Auth::attempt($credentials)) {
            // Jika berhasil, redirect ke dashboard
            session()->flash('success', 'Selamat Datang ' . Auth::user()->name);
            return redirect()->route('dashboard')->with('success', 'Selamat Datang ' . Auth::user()->name);
        } else {
            // Jika gagal, kembali ke halaman login dengan pesan error
            return redirect()->route('login')->with('error', 'Email atau Password salah');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
