<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAuthController extends Controller
{
    public function index()
    {
        return view('login.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            return redirect('test');
        }
        if (Auth::guard('siswa')->attempt($credentials)) {
            return redirect('test');
        }

        return back()->withErrors(['message' => 'Login gagal']);
    }

    // Logout siswa
    public function logout(Request $request)
    {
        auth('siswa')->logout(); // Logout dengan guard 'siswa'
        $request->session()->invalidate();
        return redirect('/login');
    }
}
