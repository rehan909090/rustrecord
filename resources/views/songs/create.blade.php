@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-semibold mb-6">Tambah Lagu Baru</h2>

        <form action="{{ route('songs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-sm font-semibold">Judul Lagu</label>
                <input type="text" id="title" name="title" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="artist" class="block text-sm font-semibold">Artis</label>
                <select name="artist" id="artist" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg" required>
                    @foreach($artists as $artist)
                        <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="genre" class="block text-sm font-semibold">Genre</label>
                <select name="genre" id="genre" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg" required>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="tempo" class="block text-sm font-semibold">Tempo</label>
                <input type="number" id="tempo" name="tempo" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="file" class="block text-sm font-semibold">File Lagu (MP3/WAV)</label>
                <input type="file" id="file" name="file" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg" required>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Simpan</button>
        </form>
    </div>
@endsection
