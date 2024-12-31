@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Tambah Konser Baru</h1>

    <form action="{{ route('concerts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium">Judul</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium">Deskripsi</label>
            <textarea id="description" name="description" class="w-full p-2 border rounded" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="location" class="block text-sm font-medium">Lokasi</label>
            <input type="text" id="location" name="location" value="{{ old('location') }}" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label for="date" class="block text-sm font-medium">Tanggal</label>
            <input type="date" id="date" name="date" value="{{ old('date') }}" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label for="ticket_price" class="block text-sm font-medium">Harga Tiket</label>
            <input type="number" id="ticket_price" name="ticket_price" value="{{ old('ticket_price') }}" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-sm font-medium">Gambar (optional)</label>
            <input type="file" id="image" name="image" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label for="artist_ids" class="block text-sm font-medium">Pilih Artis</label>
            <select id="artist_ids" name="artist_ids[]" multiple class="w-full p-2 border rounded" required>
                @foreach($artists as $artist)
                    <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded">Simpan Konser</button>
    </form>
</div>
@endsection
