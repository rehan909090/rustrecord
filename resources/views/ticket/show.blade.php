@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-semibold mb-4">Tiket Event</h2>

    <div class="ticket-container bg-white shadow-md p-6 rounded-lg mb-6 max-w-lg mx-auto">
        <!-- Header Tiket -->
        <div class="ticket-header text-center mb-4">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Aplikasi" class="w-20 mx-auto mb-4">
            <h3 class="text-xl font-bold text-gray-800">Tiket Event</h3>
        </div>

        <!-- Detail Tiket -->
        <div class="ticket-details mb-4">
            <p><strong>Nama Event:</strong> {{ $transaction->concert->title }}</p>
            <p><strong>Tanggal Event:</strong> {{ \Carbon\Carbon::parse($transaction->concert->date)->format('d M, Y') }}</p>

            <!-- Menampilkan Gambar Event -->
            @if($transaction->concert->image)
            <div class="text-center my-4">
                <img src="{{ asset('storage/'.$transaction->concert->image) }}" alt="Gambar Event" class="w-full rounded-lg">
            </div>
            @endif

            <p><strong>Status Pembayaran:</strong>
                <span class="font-semibold text-green-600">
                    Success
                </span>
            </p>

            <p>Harga Tiket: Rp {{ number_format($transaction->amount, 0, ',', '.') }}</p>

            <p class="mt-4 text-sm text-gray-600"><strong>Kode Pemesanan:</strong> {{ $transaction->order_id }}</p>
        </div>

        <!-- Button untuk kembali ke daftar event -->
        <div class="text-center mt-6">
            <a href="{{ route('concerts.index') }}" class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600">
                Kembali ke Daftar Event
            </a>
        </div>

        <!-- Tombol untuk mencetak tiket -->
        <div class="text-center mt-6">
            <button onclick="window.print()" class="px-6 py-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600">
                Cetak Tiket
            </button>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Gaya umum halaman */
    .ticket-container {
        background-color: #ffffff;
        border: 2px solid #ddd;
        padding: 20px;
        border-radius: 8px;
        max-width: 600px;
        margin: 0 auto;
        font-family: Arial, sans-serif;
    }

    .ticket-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .ticket-header h3 {
        font-size: 24px;
        font-weight: bold;
        color: #333;
    }

    .ticket-details {
        margin-bottom: 20px;
    }

    .ticket-details p {
        font-size: 16px;
        line-height: 1.5;
        color: #555;
    }

    .ticket-details .font-semibold {
        font-weight: bold;
    }

    .ticket-details img {
        max-width: 100%;
        border-radius: 8px;
        margin-top: 20px;
    }

    .ticket-details .order-id {
        font-size: 14px;
        color: #888;
    }

    /* Gaya untuk tampilan cetak */
    @media print {
        /* Menyembunyikan seluruh elemen lain saat cetak */
        body * {
            visibility: hidden;
        }

        /* Menampilkan hanya konten tiket */
        .ticket-container, .ticket-container * {
            visibility: visible;
        }

        /* Atur posisi konten tiket agar terlihat di atas */
        .ticket-container {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            margin-top: 0;
            padding-top: 20px; /* Sesuaikan jarak atas jika perlu */
        }

        /* Sembunyikan tombol print saat dicetak */
        button {
            display: none;
        }

        /* Sembunyikan elemen lain yang tidak perlu saat mencetak */
        .container, .ticket-header, .ticket-footer, .text-center, .mt-6, nav {
            display: none;
        }

        /* Style untuk bagian tiket */
        .ticket-container {
            border: 2px dashed #000;
            padding: 30px;
            margin: 0;
            width: 100%;
            max-width: 600px;
            page-break-after: always;
        }

        .ticket-header h3 {
            font-size: 26px;
            margin-bottom: 20px;
        }

        .ticket-details p {
            font-size: 20px;
            line-height: 1.5;
        }

        .ticket-details .font-semibold {
            font-weight: bold;
        }

        .ticket-details {
            border-bottom: 2px solid #ddd;
            padding-bottom: 20px;
        }

        .text-center {
            text-align: center;
        }

        /* Jangan tampilkan tombol print saat dicetak */
        button {
            display: none; 
        }
    }
</style>
@endsection
