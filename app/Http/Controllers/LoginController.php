<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Jika berhasil, buat session
        $request->session()->regenerate();
        return redirect()->intended('home'); // Pindah ke home
    }

    // Jika gagal, balik ke login dengan pesan error
    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
}
}
