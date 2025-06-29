<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Karyawan;
//buat web App
class AuthWebController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $karyawan = Karyawan::where('username', $request->username)->first();

        if (!$karyawan) {
            return back()->with('error', 'Username tidak ditemukan.');
        }

        if (!Hash::check($request->password, $karyawan->password)) {
            return back()->with('error', 'Password salah.');
        }

        auth()->login($karyawan);
        return redirect()->route('dashboard.role');
    }


    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
