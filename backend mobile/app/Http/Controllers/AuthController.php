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
}
