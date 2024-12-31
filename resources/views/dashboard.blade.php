<!-- resources/views/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-semibold text-gray-800 mb-6">Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Total Artis -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold text-gray-800">Total Artis</h2>
                <p class="text-gray-600 mt-2">Jumlah total artis dalam sistem.</p>
                <div class="mt-4">
                    <span class="text-4xl font-bold text-indigo-600">{{ $totalArtist }}</span>
                </div>
            </div>

            <!-- Total Music Submission -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold text-gray-800">Total Music Submission</h2>
                <p class="text-gray-600 mt-2">Jumlah total submission musik yang ada dalam sistem.</p>
                <div class="mt-4">
                    <span class="text-4xl font-bold text-indigo-600">{{ $totalMusicSubmission }}</span>
                </div>
            </div>

            <!-- Total Event -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold text-gray-800">Total Event</h2>
                <p class="text-gray-600 mt-2">Jumlah total event yang ada dalam sistem.</p>
                <div class="mt-4">
                    <span class="text-4xl font-bold text-indigo-600">{{ $totalConcert }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
