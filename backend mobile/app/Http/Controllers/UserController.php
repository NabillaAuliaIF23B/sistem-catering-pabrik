<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // nampilin data karyawan
    public function index()
    {
        return Karyawan::all();
    }

    //hapus karyawan
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'User deleted']);
    }

}
