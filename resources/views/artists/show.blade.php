<!-- resources/views/artists/show.blade.php -->

@extends('layouts.app')

@section('content')

    <div class="container mx-auto p-6">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="flex flex-col md:flex-row">
                <!-- Gambar Artis -->
                <div class="md:w-1/3">
                    <img src="{{ asset('storage/'.$artist->foto_artis) }}" alt="{{ $artist->name }}" class="w-full h-64 object-cover rounded-lg">
                </div>

                <!-- Detail Artis -->
                <div class="md:w-2/3 p-6">
                    <h1 class="text-3xl font-bold text-gray-800">{{ $artist->name }}</h1>
                    <p class="text-gray-600 mt-2"><strong>Tempat Tinggal:</strong> {{ $artist->tempat_tinggal ?? 'Tidak Tersedia' }}</p>
                    <p class="text-gray-600 mt-2"><strong>Tanggal Lahir:</strong> {{ \Carbon\Carbon::parse($artist->tanggal_lahir)->format('d F Y') ?? 'Tidak Tersedia' }}</p>
                    <p class="text-gray-600 mt-2"><strong>Status:</strong> {{ $artist->status ?? 'Tidak Tersedia' }}</p>
                    <p class="text-gray-600 mt-2"><strong>Pekerjaan:</strong> {{ $artist->pekerjaan ?? 'Tidak Tersedia' }}</p>
                    <p class="text-gray-600 mt-2"><strong>Bio:</strong> {{ $artist->bio ?? 'Tidak Tersedia' }}</p>

                   
                </div>
            </div>
            
        </div>
    </div>
@endsection
