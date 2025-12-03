<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\User;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PageController extends Controller
{
    //
    public function getHomePage()
    {
        $username = Auth::check() ? Auth::user()->username : null;
        $fotos = Galeri::get();
        $users = User::get();

        return view('page.homepage', compact('username', 'fotos', 'users'));
    }

    public function getTambahKegiatan()
    {
        return view('page.formact');
    }

    public function postTambahKegiatan(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'kegiatan' => 'required',
        ]);

        Kegiatan::create([
            'tanggal' => $request->tanggal,
            'kegiatan' => $request->kegiatan,
        ]);

        return redirect()->route('homepage')->with('success');
    }
}
