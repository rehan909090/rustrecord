@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-semibold mb-6">Daftar Lagu</h2>

        <!-- Link untuk menambah lagu baru -->
        <a href="{{ route('songs.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg mb-4 inline-block">
            Tambah Lagu Baru
        </a>

        <!-- Daftar lagu yang ada -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($songs as $song)
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold">{{ $song->title }}</h3>
                    <!-- Menampilkan nama artis dan genre -->
                    <p><strong>Artis:</strong> {{ $song->artist->name }}</p>
                    <p><strong>Genre:</strong> {{ $song->genre->name }}</p>
                    <p><strong>Tempo:</strong> {{ $song->tempo }} BPM</p>

                    <!-- Pemutar audio -->
                    <audio controls class="w-full mt-4" data-song-id="{{ $song->id }}">
                        <source src="{{ asset('storage/' . $song->file_path) }}" type="audio/mp3">
                        Your browser does not support the audio element.
                    </audio>

                    <!-- Form untuk menghapus lagu -->
                    <form action="{{ route('songs.destroy', $song->id) }}" method="POST" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                            Hapus Lagu
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection
