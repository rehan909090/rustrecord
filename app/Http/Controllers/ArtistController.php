<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtistController extends Controller
{
    // Menampilkan daftar artis
    public function index()
    {
        $artists = Artist::all();
        return view('artists.index', compact('artists'));
    }

    // Menampilkan form untuk membuat artis baru
    public function create()
    {
        return view('artists.create');
    }

    // Menyimpan artis baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'tempat_tinggal' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'status' => 'nullable|string',
            'pekerjaan' => 'nullable|in:Mahasiswa,Pekerja,Tidak ada', // Validasi untuk pekerjaan
            'foto_artis' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Upload foto jika ada
        $path = null;
        if ($request->hasFile('foto_artis')) {
            $path = $request->file('foto_artis')->store('artists', 'public');
        }

        // Menyimpan data artis ke database
        Artist::create([
            'name' => $request->name,
            'bio' => $request->bio,
            'tempat_tinggal' => $request->tempat_tinggal,
            'tanggal_lahir' => $request->tanggal_lahir,
            'status' => $request->status,
            'pekerjaan' => $request->pekerjaan,
            'foto_artis' => $path ?? null,
        ]);

        return redirect()->route('artists.index')->with('success', 'Artis berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit artis
    public function edit(Artist $artist)
    {
        return view('artists.edit', compact('artist'));
    }

    // Memperbarui data artis
    public function update(Request $request, Artist $artist)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'tempat_tinggal' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'status' => 'nullable|string',
            'pekerjaan' => 'nullable|in:Mahasiswa,Pekerja,Tidak ada', // Validasi pekerjaan
            'foto_artis' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Jika ada file foto baru
        if ($request->hasFile('foto_artis')) {
            // Hapus foto lama jika ada
            if ($artist->foto_artis && Storage::exists('public/' . $artist->foto_artis)) {
                Storage::delete('public/' . $artist->foto_artis);
            }

            // Upload foto baru
            $path = $request->file('foto_artis')->store('artists', 'public');
            $artist->foto_artis = $path;
        }

        // Update data artis
        $artist->name = $request->name;
        $artist->bio = $request->bio;
        $artist->tempat_tinggal = $request->tempat_tinggal;
        $artist->tanggal_lahir = $request->tanggal_lahir;
        $artist->status = $request->status;
        $artist->pekerjaan = $request->pekerjaan;
        $artist->save();

        return redirect()->route('artists.index')->with('success', 'Artis berhasil diperbarui!');
    }

    // Menampilkan detail artis
    public function show(Artist $artist)
    {
        return view('artists.show', compact('artist'));
    }

    // Menghapus artis
    public function destroy(Artist $artist)
    {
        // Hapus foto artis jika ada
        if ($artist->foto_artis && Storage::exists('public/' . $artist->foto_artis)) {
            Storage::delete('public/' . $artist->foto_artis);
        }

        // Hapus data artis
        $artist->delete();
        return redirect()->route('artists.index')->with('success', 'Artis berhasil dihapus!');
    }
}
