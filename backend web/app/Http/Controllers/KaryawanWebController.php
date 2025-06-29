<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Karyawan;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Mail;
use App\Mail\AkunBaruMail;


class KaryawanWebController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $users = Karyawan::where('nama', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->get();

        return view('hrga.user', compact('users', 'search'));
    }

    public function create()
    {
        return view('hrga.create-user');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:karyawan,email',
            'username' => 'required|string|max:50|unique:karyawan,username',
            'password' => 'required|min:6',
            'role' => 'required|in:karyawan,koki,hrga',
            'tanggal_masuk' => 'required|date',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // validasi file foto
        ]);
        
        

        $plainPassword = $request->input('password');
        Log::info('Plain password (input): ' . $plainPassword);

        // Upload foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('fotos'), $filename);
        } else {
            $filename = null;
        }

        $karyawan = new Karyawan();
        $karyawan->nama = $request->nama;
        $karyawan->email = $request->email;
        $karyawan->username = $request->username;
        $karyawan->password = $plainPassword;  // nanti di model otomatis hash
        $karyawan->role = $request->role;
        $karyawan->tanggal_masuk = $request->tanggal_masuk;
        $karyawan->foto = $filename;  // simpan nama file ke DB
        $karyawan->save();

        Mail::to($karyawan->email)->send(new AkunBaruMail([
            'nama' => $karyawan->nama,
            'username' => $karyawan->username,
            'password' => $plainPassword
        ]));

        return redirect()->route('user.index')->with('success', 'Akun berhasil dibuat dan email dikirim.');
    }



    public function edit($id)
    {
        $user = Karyawan::findOrFail($id);
        return view('hrga.edit-user', compact('user'));
    }

    public function update(Request $request, $id)
{
    $user = Karyawan::findOrFail($id);

    // Validasi input
    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:karyawan,email,' . $id . ',id_karyawan',
        'username' => 'required|string|max:50|unique:karyawan,username,' . $id . ',id_karyawan',
        'role' => 'required|in:karyawan,koki,hrga',
        'tanggal_masuk' => 'required|date',
        'password' => 'nullable|min:6',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Ambil data
    $data = $request->only('nama', 'username', 'email', 'role', 'tanggal_masuk');

    // Password baru (jangan di-hash di controller)
    if ($request->filled('password')) {
        $plainPassword = $request->input('password');
        $data['password'] = $plainPassword;

        // Kirim email password baru
        Mail::to($user->email)->send(new AkunBaruMail([
            'nama' => $user->nama,
            'username' => $user->username,
            'password' => $plainPassword
        ]));
    }

    // Upload foto baru jika ada
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('fotos'), $filename);
        $data['foto'] = $filename;
    }

    $user->update($data);

    return redirect()->route('user.index')->with('success', 'Data karyawan berhasil diperbarui.');
}



    // Hapus user
    public function destroy($id)
    {
        $user = Karyawan::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus.');
    }

    // Toggle status aktif / tidak aktif
    public function toggleStatus($id)
    {
        $user = Karyawan::findOrFail($id);
        $user->status = ($user->status == 'aktif') ? 'nonaktif' : 'aktif';
        $user->save();

        return redirect()->route('user.index')->with('success', 'Status user berhasil diubah.');
    }
    
    




}
