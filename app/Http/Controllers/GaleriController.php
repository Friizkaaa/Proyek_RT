<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    //
    public function getFormGaleri()
    {
        return view('page.formgaleri');
    }

    public function postFormGaleri(Request $request)
    {
        $request->validate([
            'foto' => 'required|image:mimas:jepg,png,jpg|max:5048',
            'judul' => 'required|string|max:100',
            'deskripsi' => 'required|string|max:200',
            'tanggal' => 'required|date',
        ]);

        $path = $request->file('foto')->store('galeri', 'public');

        Galeri::create([
            'foto' => $path,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('homepage')->with('success', 'Foto berhasil ditambahkan');
    }

    public function postDeleteFoto()
    {
        
    }
}
