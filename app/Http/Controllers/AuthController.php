<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

use App\Models\User;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLoginForm()
    {
        return view('page.masukpage');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba login
        if (Auth::attempt($request->only('email', 'password'))) {
            // Regenerate session untuk keamanan
            $request->session()->regenerate();
            // Redirect ke homepage
            return redirect()->intended('/');
        }

        throw ValidationException::withMessages([
            'email' => ['Email atau password salah.'],
        ]);
    }

    //
    public function showRegisterForm() 
    {
        return view('page.daftarpage');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email'             => 'required|email|unique:users,email',
            'password'          => 'required|min:6',
            'kode_warga'        => 'required|in:IBRU02',
            'nama_lengkap'      => 'required',
            'nik'               => 'required|digits:16',
            'alamat'            => 'required',
            'tanggal_lahir'     => 'required|date',
            'pekerjaan'         => 'required',
            'status_keluarga'   => 'required|in:kepala_keluarga,anggota_keluarga,lajang,janda/duda',
            'no_hp'             => 'required|digits_between:10,13',
            'username'          => 'required|unique:users,username',
        ]);

        User::create([
            'username'          => $request->username,
            'email'             => $request->email,
            'password'          => bcrypt($request->password),
            'kode_warga'        => $request->kode_warga,
            'nama_lengkap'      => $request->nama_lengkap,
            'nik'               => $request->nik,
            'alamat'            => $request->alamat,
            'tanggal_lahir'     => $request->tanggal_lahir,
            'pekerjaan'         => $request->pekerjaan,
            'status_keluarga'   => $request->status_keluarga,
            'no_hp'             => $request->no_hp,
        ]);

        return redirect()->route('login')->with('success','Registrasi berhasil, silakan login!');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}