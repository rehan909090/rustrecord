@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>

<div class="container mx-auto p-8">
    <!-- Judul Halaman -->
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">Daftar Konser</h1>

    <!-- Tombol Tambah Konser -->
    <div class="mb-6 text-right">
        <a href="{{ route('concerts.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700 transition-colors duration-300">
            + Tambah Konser
        </a>
    </div>
    @if(session('success'))
    <div class="bg-green-500 text-white p-4 mb-4 rounded">
        {{ session('success') }}
    </div>
@endif


    <!-- Grid Konser -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($concerts as $concert)
            <div class="bg-white shadow-xl rounded-lg overflow-hidden transition-transform transform hover:scale-105 duration-300 hover:shadow-2xl">
                <!-- Gambar Konser -->
                @if($concert->image)
                    <img src="{{ asset('storage/' . $concert->image) }}" alt="Concert Image" class="w-full h-56 object-cover transition-transform duration-300 transform hover:scale-110">
                @endif

                <div class="p-6">
                    <!-- Judul Konser -->
                    <h2 class="text-2xl font-semibold text-blue-600 hover:text-blue-800 mb-2">{{ $concert->title }}</h2>

                    <!-- Deskripsi Singkat -->
                    <p class="text-gray-600 text-sm">{{ Str::limit($concert->description, 120) }}</p>

                    <!-- Lokasi dan Tanggal -->
                    <div class="mt-4 text-sm text-gray-500">
                        <p><strong>Lokasi:</strong> {{ $concert->location }}</p>
                        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($concert->date)->format('d M Y') }}</p>
                        <p><strong>Harga Tiket:</strong> Rp. {{ number_format($concert->ticket_price, 0, ',', '.') }}</p>
                    </div>


                    <!-- Tombol Lihat Detail, Edit, Hapus -->
                    <div class="mt-6 flex justify-between items-center">
                        <a href="{{ route('concerts.show', $concert->id) }}" class="text-blue-600 hover:text-white hover:bg-blue-600 text-sm font-semibold px-4 py-2 rounded transition-colors duration-300">
                            Lihat Detail
                        </a>

                        <!-- Edit Konser -->
                        <a href="{{ route('concerts.edit', $concert->id) }}" class="text-yellow-500 hover:text-white hover:bg-yellow-500 text-sm font-semibold px-4 py-2 rounded transition-colors duration-300">
                            Edit
                        </a>

                        <!-- Hapus Konser -->
                        <form action="{{ route('concerts.destroy', $concert->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus konser ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 transition-colors duration-300">
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
