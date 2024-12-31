<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Artist;
use App\Models\Genre;  // Perbaiki di sini, ganti Genre dengan Genres
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SongController extends Controller
{
    public function index()
    {
        // Menambahkan relasi dengan artist dan genre untuk setiap lagu
        $songs = Song::with(['artist', 'genre'])->get();
        return view('songs.index', compact('songs'));
    }

    public function create()
    {
        // Mengambil semua data artist dan genre dari database
        $artists = Artist::all();
        $genres = Genre::all(); // Ganti di sini, ganti Genre dengan Genres
        return view('songs.create', compact('artists', 'genres'));
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'title' => 'required',
            'artist' => 'required|exists:artists,id',
            'genre' => 'required|exists:genres,id', // Menggunakan relasi genres
            'tempo' => 'required|integer',
            'file' => 'required|file|mimes:mp3,wav',
        ]);

        // Menyimpan file lagu
        $path = $request->file('file')->store('public/songs');

        // Membuat data lagu baru
        Song::create([
            'title' => $request->title,
            'artist_id' => $request->artist,
            'genre_id' => $request->genre,
            'tempo' => $request->tempo,
            'file_path' => $path,
        ]);

        // Redirect ke halaman index setelah data lagu berhasil disimpan
        return redirect()->route('songs.index');
    }

    public function destroy($id)
    {
        // Menghapus data lagu berdasarkan ID
        $song = Song::findOrFail($id);
        Storage::delete($song->file_path); // Menghapus file lagu yang disimpan
        $song->delete(); // Menghapus data lagu dari database

        return redirect()->route('songs.index');
    }

    public function incrementPlayCount($id)
    {
        // Menambah jumlah play count untuk lagu yang dipilih
        $song = Song::findOrFail($id);
        $song->increment('play_count');
        return response()->json(['play_count' => $song->play_count]);
    }
}
