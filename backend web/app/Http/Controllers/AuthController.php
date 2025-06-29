<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Models\Karyawan;



class AuthController extends Controller
{
    //login App
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = Karyawan::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Cek status akun
        if ($user->status !== 'aktif') {
            return response()->json(['message' => 'Akun tidak aktif'], 403);
        }

        // Buat token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'role' => $user->role,
            'nama' => $user->nama,
            'username' => $user->username,
        ]);
    }

    public function profile(Request $request)
    {
        return response()->json($request->user());
    }
    
    public function gantiPassword(Request $request)
    {
        $request->validate([
            'password_baru' => 'required|string|min:6',
        ]);
    
        $user = $request->user(); // Ambil user dari token
        $user->password = $request->password_baru; // TANPA HASH (hanya untuk testing/permintaan kamu)
        $user->save();
    
        return response()->json(['message' => 'Password berhasil diganti.']);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out']);
    }

}
