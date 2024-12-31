<!-- resources/views/artists/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4">Edit Artis</h1>

        <form action="{{ route('artists.update', $artist->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nama</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-md" value="{{ old('name', $artist->name) }}" required>
            </div>

            <div class="mb-4">
                <label for="bio" class="block text-gray-700">Bio</label>
                <textarea name="bio" id="bio" class="w-full px-4 py-2 border rounded-md">{{ old('bio', $artist->bio) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="tempat_tinggal" class="block text-gray-700">Tempat Tinggal</label>
                <input type="text" name="tempat_tinggal" id="tempat_tinggal" class="w-full px-4 py-2 border rounded-md" value="{{ old('tempat_tinggal', $artist->tempat_tinggal) }}">
            </div>

            <div class="mb-4">
                <label for="tanggal_lahir" class="block text-gray-700">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="w-full px-4 py-2 border rounded-md" value="{{ old('tanggal_lahir', $artist->tanggal_lahir) }}">
            </div>

            <div class="mb-4">
                <label for="status" class="block text-gray-700">Status</label>
                <input type="text" name="status" id="status" class="w-full px-4 py-2 border rounded-md" value="{{ old('status', $artist->status) }}">
            </div>

            <div class="mb-4">
                <label for="pekerjaan" class="block text-gray-700">Pekerjaan</label>
                <input type="text" name="pekerjaan" id="pekerjaan" class="w-full px-4 py-2 border rounded-md" value="{{ old('pekerjaan', $artist->pekerjaan) }}">
            </div>

            <div class="mb-4">
                <label for="foto_artis" class="block text-gray-700">Foto Artis</label>
                <input type="file" name="foto_artis" id="foto_artis" class="w-full px-4 py-2 border rounded-md">
                @if($artist->foto_artis)
                    <img src="{{ asset('storage/'.$artist->foto_artis) }}" alt="{{ $artist->name }}" class="mt-2 w-32 h-32 object-cover">
                @endif
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Update</button>
        </form>
    </div>
@endsection
