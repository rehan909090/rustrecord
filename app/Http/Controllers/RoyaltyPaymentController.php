<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
use Midtrans\Config;
use Midtrans\Snap;

class RoyaltyPaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PROD', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    // Menampilkan halaman pembayaran royalti untuk artis tertentu
    public function showPaymentForm($artistId)
    {
        $artist = Artist::findOrFail($artistId);

        return view('payment.royalty', compact('artist'));
    }

    // Memproses pembayaran
    public function processPayment(Request $request, $artistId)
    {
        $artist = Artist::findOrFail($artistId);

        $transactionDetails = [
            'order_id' => 'royalty-' . time(),
            'gross_amount' => $artist->royalty_balance, // Jumlah royalti
        ];

        $customerDetails = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ];

        $paymentData = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
        ];

        try {
            $paymentUrl = Snap::createTransaction($paymentData)->redirect_url;
            return redirect($paymentUrl);
        } catch (\Exception $e) {
            return back()->with('error', 'Pembayaran gagal: ' . $e->getMessage());
        }
    }

    // Callback Midtrans (Opsional, untuk memverifikasi pembayaran)
    public function callback(Request $request)
    {
        // Logika callback untuk menangani status pembayaran dari Midtrans
    }
}
