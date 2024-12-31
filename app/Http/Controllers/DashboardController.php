<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\MusicSubmission;
use App\Models\Concert; // Tambahkan ini untuk model Event

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung jumlah total artis
        $totalArtist = Artist::count();

        // Hitung jumlah total music submission
        $totalMusicSubmission = MusicSubmission::count();

        // Hitung jumlah total event
        $totalConcert = Concert::count(); // Ambil jumlah event

        // Kirim variabel ke view
        return view('dashboard', compact('totalArtist', 'totalMusicSubmission', 'totalConcert'));
    }
}
