@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>

<div class="max-w-7xl mx-auto p-6">
    <!-- Card untuk Detail Konser -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Header Card -->
        <div class="relative">
            @if($concert->image)
                <img src="{{ asset('storage/' . $concert->image) }}" alt="Concert Image" class="w-full h-72 object-cover">
            @else
                <div class="bg-gray-300 w-full h-72 flex items-center justify-center">
                    <span class="text-white text-xl">No Image Available</span>
                </div>
            @endif
            <div class="absolute top-4 left-4 bg-black bg-opacity-50 p-2 rounded">
                <h1 class="text-4xl font-bold text-white">{{ $concert->title }}</h1>
            </div>
        </div>

        <!-- Body Card -->
        <div class="p-6 space-y-6">
            <!-- Deskripsi -->
            <div>
                <strong class="text-xl text-gray-800">Deskripsi:</strong>
                <p class="mt-2 text-gray-600">{{ $concert->description ?? 'Tidak ada deskripsi tersedia.' }}</p>
            </div>

            <!-- Lokasi -->
            <div>
                <strong class="text-xl text-gray-800">Lokasi:</strong>
                <p class="mt-2 text-gray-600">{{ $concert->location ?? 'Lokasi belum ditentukan.' }}</p>
            </div>

            <!-- Tanggal -->
            <div>
                <strong class="text-xl text-gray-800">Tanggal:</strong>
                <p class="mt-2 text-gray-600">
                    {{ $concert->date ? \Carbon\Carbon::parse($concert->date)->format('d M, Y') : 'Tanggal belum ditentukan.' }}
                </p>
            </div>

            <!-- Harga Tiket -->
            <div>
                <strong class="text-xl text-gray-800">Harga Tiket:</strong>
                <p class="mt-2 text-gray-600">
                    Rp {{ $concert->ticket_price ? number_format($concert->ticket_price, 0, ',', '.') : 'Gratis' }}
                </p>
            </div>

            <!-- Artis yang Tampil -->
            <div>
                <strong class="text-xl text-gray-800">Artis yang Tampil:</strong>
                <ul class="mt-2 space-y-2 text-gray-600">
                    @forelse ($concert->artists as $artist)
                        <li>{{ $artist->name }}</li>
                    @empty
                        <li>Tidak ada artis yang tampil pada konser ini.</li>
                    @endforelse
                </ul>
            </div>

            <!-- Tombol Pembelian Tiket -->
            <div>
                <form action="{{ route('payment.create', $concert->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="ticket_price" value="{{ $concert->ticket_price }}">
                    
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                        Beli Tiket
                    </button>
                </form>
            </div>

            <!-- Notifikasi Pesan -->
            @if(session('message'))
                <div class="mt-4 p-4 bg-green-100 text-green-800 rounded-lg">
                    {{ session('message') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mt-4 p-4 bg-red-100 text-red-800 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
