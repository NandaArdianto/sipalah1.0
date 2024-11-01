<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Coba login menggunakan guard 'admin'
        if (Auth::guard('admin')->attempt($credentials)) {
            // Login sukses, redirect ke dashboard
            return redirect()->intended('/dashboard');
        }

        // Login gagal
        return back()->withErrors([
            'email' => 'Email atau Password yang anda masukan salah :)',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate(); // Menghapus session
        $request->session()->regenerateToken(); // Menghasilkan token CSRF baru

        return redirect('/login'); // Arahkan kembali ke halaman login

    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        // Ambil admin yang sedang login
        $admin = Auth::guard('admin')->user();

        // Cek apakah password saat ini benar
        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak cocok.']);
        }

        // Update password baru
        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return redirect()->back()->with('status', 'Password berhasil diganti.');
    }
}
