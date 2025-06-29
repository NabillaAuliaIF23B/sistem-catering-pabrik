<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;

        if ($role === 'hrga') {
            return view('hrga.profile', compact('user')); // Kirim $user ke Blade
        } elseif ($role === 'koki') {
            return view('koki.profile', compact('user')); // Kirim $user ke Blade
        } else {
            abort(403, 'Role tidak dikenali: ' . $role);
        }
    }
}
