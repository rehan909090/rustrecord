@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-semibold mb-4">Checkout Pembayaran</h2>

    <!-- Informasi Konser -->
    <div class="bg-white shadow-md p-4 rounded-lg mb-6">
        <!-- Gambar Konser -->
        @if($concert->image)
            <img src="{{ asset('storage/' . $concert->image) }}" alt="Gambar Konser" class="w-full h-48 object-cover rounded mb-4">
        @else
            <div class="bg-gray-300 w-full h-48 flex items-center justify-center rounded mb-4">
                <span class="text-gray-700">Tidak ada gambar tersedia</span>
            </div>
        @endif

        <!-- Detail Konser -->
        <div class="text-gray-800">
            <p><strong>Nama Konser:</strong> <span class="text-blue-600 font-semibold">{{ e($concert->title) }}</span></p>
            <p><strong>Lokasi:</strong> <span class="text-gray-600">{{ e($concert->location) }}</span></p>
            <p><strong>Tanggal:</strong> <span class="text-gray-600">{{ \Carbon\Carbon::parse($concert->date)->format('d M, Y') }}</span></p>
            <p><strong>Harga Tiket:</strong> <span class="text-green-600 font-semibold">Rp {{ number_format($ticket_price, 0, ',', '.') }}</span></p>
        </div>

        <!-- Deskripsi Konser -->
        <div class="mt-6 border-t border-gray-200 pt-4">
            <h3 class="text-lg font-semibold text-gray-800">Deskripsi:</h3>
            <p class="mt-2 text-gray-700 italic leading-relaxed">
                <span class="text-gray-500">"</span>
                {{ e($concert->description) }}
                <span class="text-gray-500">"</span>
            </p>
        </div>
    </div>

    <!-- Tombol Bayar -->
    <div class="flex justify-center">
        @if(!empty($snapToken))
            <button id="pay-button" class="px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-500 text-white font-semibold rounded-lg hover:from-blue-600 hover:to-purple-600 shadow-lg transition duration-300 transform hover:scale-105">
                Bayar Sekarang
            </button>
        @else
            <p class="text-red-500">Token pembayaran tidak tersedia. Silakan coba lagi.</p>
        @endif
    </div>
</div>

<!-- Script untuk memproses pembayaran dengan Midtrans -->
<script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

<script type="text/javascript">
    document.getElementById('pay-button')?.addEventListener('click', function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                // Jika pembayaran berhasil, alihkan ke halaman tiket dengan order_id
                window.location.href = `/ticket/${result.order_id}`;
            },
            onPending: function(result) {
                alert('Pembayaran sedang diproses. Mohon tunggu.');
                console.log(result);
                window.location.href = "{{ route('concerts.index') }}";
            },
            onError: function(result) {
                alert('Pembayaran gagal. Silakan coba lagi.');
                console.log(result);
                window.location.href = "{{ route('concerts.index') }}";
            },
            onClose: function() {
                alert('Anda menutup halaman pembayaran tanpa menyelesaikan transaksi.');
            }
        });
    });
</script>
@endsection
