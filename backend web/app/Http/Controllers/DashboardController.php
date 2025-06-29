<?php 

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'hrga') {
            return view('hrga.dashboard', compact('user'));
        } elseif ($user->role === 'karyawan') {
            return view('karyawan.dashboard', compact('user'));
        } elseif ($user->role === 'koki') {
            return view('koki.profile', compact('user'));
        } else {
            abort(403);
        }
    }
}
