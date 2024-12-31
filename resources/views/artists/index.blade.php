<!-- resources/views/artists/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-semibold text-center mb-8 text-gray-900">Daftar Artis</h1>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-end mb-6">
            <a href="{{ route('artists.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md shadow-md transition-all duration-300">
                Tambah Artis
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($artists as $artist)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-all duration-200 hover:scale-105">
                    <img src="{{ $artist->foto_artis ? asset('storage/'.$artist->foto_artis) : 'default-image.jpg' }}" alt="{{ $artist->name }}" class="w-full h-48 object-cover">

                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $artist->name }}</h3>
                        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($artist->bio, 100) }}</p>
                        
                        <div class="flex justify-between items-center mt-4">
                            <a href="{{ route('artists.show', $artist->id) }}" class="bg-blue-600 text-white py-2 px-4 rounded-md text-sm hover:bg-blue-700 transition-all duration-200">
                                Lihat Detail
                            </a>
                            <a href="{{ route('artists.edit', $artist->id) }}" class="bg-yellow-600 text-white py-2 px-4 rounded-md text-sm hover:bg-yellow-700 transition-all duration-200">
                                Edit
                            </a>
                            <form action="{{ route('artists.destroy', $artist->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artis ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-md text-sm hover:bg-red-700 transition-all duration-200">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
