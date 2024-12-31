<?php

namespace App\Http\Controllers;

use App\Models\MusicSubmission;
use App\Models\Genre;
use Illuminate\Http\Request;

class MusicSubmissionController extends Controller
{

    public function index()
{
    // Mengambil semua data music submissions beserta genre-nya
    $musicSubmissions = MusicSubmission::with('genre')->get();

    // Return ke view dengan data
    return view('music_submissions.index', compact('musicSubmissions'));
}

    /**
     * Tampilkan form submit musik.
     */
    public function showForm()
    {
        // Ambil semua genre dari database
        $genres = Genre::all(); 
        return view('music.submit', compact('genres'));
    }

    /**
     * Proses pengajuan musik.
     */
    public function submitMusic(Request $request)
    {
        // Validasi input
        $request->validate([
            'song_title' => 'required|string|max:255',
            'artist_name' => 'required|string|max:255',
            'genre' => 'required|exists:genres,id',
            'music_file' => 'required|mimes:mp3,wav,ogg|max:20240', // Maksimal 20MB
        ]);

        // Mengunggah file musik ke storage dan mendapatkan path-nya
        $filePath = $request->file('music_file')->store('music', 'public');

        // Simpan pengajuan musik ke database
        MusicSubmission::create([
            'song_title' => $request->song_title,
            'artist_name' => $request->artist_name,
            'genre_id' => $request->genre,
            'file_path' => $filePath,
            'status' => 'pending',
        ]);

        

        // Redirect ke dashboard dengan pesan sukses
        return redirect()->route('dashboard')->with('status', 'Music submitted successfully!');
    }


// Menampilkan form untuk mengedit status
public function editStatusForm(MusicSubmission $submission)
{
    return view('music_submissions.edit_status', compact('submission'));
}

// Mengupdate status submission
public function updateStatus(Request $request, MusicSubmission $submission)
{
    // Validasi status yang dipilih
    $request->validate([
        'status' => 'required|in:approved,rejected',
    ]);

    // Update status submission
    $submission->update([
        'status' => $request->status,
    ]);

    return redirect()->route('music.submissions')->with('status', 'Status berhasil diperbarui!');
}
// Menghapus music submission
public function destroy(MusicSubmission $submission)
{
    // Menghapus file musik dari storage
    \Storage::disk('public')->delete($submission->file_path);

    // Menghapus data submission dari database
    $submission->delete();

    // Redirect kembali ke halaman daftar music submissions dengan pesan sukses
    return redirect()->route('music.submissions')->with('status', 'Submission berhasil dihapus!');
}

}
