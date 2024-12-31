<!-- resources/views/artists/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4">Tambah Artis</h1>

        <form action="{{ route('artists.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nama</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-md" value="{{ old('name') }}" required>
            </div>

            <div class="mb-4">
                <label for="bio" class="block text-gray-700">Bio</label>
                <textarea name="bio" id="bio" class="w-full px-4 py-2 border rounded-md">{{ old('bio') }}</textarea>
            </div>

            <div class="mb-4">
                <label for="tempat_tinggal" class="block text-gray-700">Tempat Tinggal</label>
                <input type="text" name="tempat_tinggal" id="tempat_tinggal" class="w-full px-4 py-2 border rounded-md" value="{{ old('tempat_tinggal') }}">
            </div>

            <div class="mb-4">
                <label for="tanggal_lahir" class="block text-gray-700">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="w-full px-4 py-2 border rounded-md" value="{{ old('tanggal_lahir') }}">
            </div>

            <div class="mb-4">
                <label for="status" class="block text-gray-700">Status</label>
                <input type="text" name="status" id="status" class="w-full px-4 py-2 border rounded-md" value="{{ old('status') }}">
            </div>

            <div class="mb-4">
                <label for="pekerjaan" class="block text-gray-700">Pekerjaan</label>
                <input type="text" name="pekerjaan" id="pekerjaan" class="w-full px-4 py-2 border rounded-md" value="{{ old('pekerjaan') }}">
            </div>

            <div class="mb-4">
                <label for="foto_artis" class="block text-gray-700">Foto Artis</label>
                <input type="file" name="foto_artis" id="foto_artis" class="w-full px-4 py-2 border rounded-md">
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Simpan</button>
        </form>
    </div>
@endsection
