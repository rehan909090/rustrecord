<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Concert;
use App\Models\Transaction;
use App\Models\Artist;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Configuring Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createTransaction(Request $request, $concert_id)
    {
        // Retrieve concert data
        $concert = Concert::find($concert_id);

        if (!$concert) {
            return redirect()->back()->with('error', 'Concert not found');
        }

        $ticket_price = $concert->ticket_price;

        // Ensure ticket price is valid
        if ($ticket_price <= 0) {
            return redirect()->back()->with('error', 'Invalid ticket price');
        }

        // Generate unique order ID
        $orderId = 'order-' . uniqid();

        // Create transaction record
        $transaction = Transaction::create([
            'concert_id' => $concert_id,
            'order_id' => $orderId,
            'amount' => $ticket_price,
            'status' => 'pending',
            'payment_type' => 'midtrans',
        ]);

        $firstName = auth()->check() ? auth()->user()->name : 'Guest';
        $email = auth()->check() ? auth()->user()->email : 'guest@example.com';

        // Data for Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $ticket_price,
            ],
            'customer_details' => [
                'first_name' => $firstName,
                'email' => $email,
            ],
        ];

        try {
            // Get Snap token from Midtrans
            $snapToken = Snap::getSnapToken($params);

            // Return payment view with concert, ticket price, and snap token
            return view('payment', compact('concert', 'ticket_price', 'snapToken', 'transaction'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create transaction: ' . $e->getMessage());
        }
    }

    public function paymentCallback(Request $request)
    {
        // Mendapatkan data dari callback
        $json = json_decode($request->getContent(), true);
    
        // Mendapatkan order_id dan status transaksi dari callback
        $orderId = $json['order_id'];
        $transactionStatus = $json['transaction_status'];
    
        // Cari transaksi berdasarkan order_id
        $transaction = Transaction::where('order_id', $orderId)->first();
    
        // Jika transaksi ditemukan, update statusnya ke 'success'
        if ($transaction) {
            // Always set the status to 'success'
            $transaction->status = 'success';
    
            // Save the updated transaction
            $transaction->save();
    
            // Redirect to the ticket page after updating the status
            return redirect()->route('ticket.show', ['order_id' => $orderId]);
        }
    
        // Kembalikan response sebagai tanda callback sudah diproses
        return response()->json(['message' => 'Callback processed']);
    }
    
    public function handleNotification(Request $request)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $json = $request->getContent();
        $notification = json_decode($json);

        // Validasi Signature Key
        $signatureKey = hash('sha512', $notification->order_id . $notification->status_code . $notification->gross_amount . $serverKey);
        if ($signatureKey !== $notification->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // Pastikan pembayaran sukses
        if ($notification->transaction_status === 'settlement') {
            $payment = Payment::where('order_id', $notification->order_id)->first();

            if ($payment) {
                // Tandai pembayaran sukses
                $payment->status = 'paid';
                $payment->save();

                // Distribusi pendapatan ke artis
                $concert = $payment->concert;
                $artists = $concert->artists;

                // Jika ada artis yang terlibat, bagi rata pembayaran
                if ($artists->count() > 0) {
                    $sharePerArtist = $payment->amount / $artists->count();

                    foreach ($artists as $artist) {
                        // Increment payment_balance untuk masing-masing artis
                        $artist->payment_balance += $sharePerArtist;
                        $artist->save();
                    }
                }
            }
        }

        return response()->json(['message' => 'Notification processed']);
    }
}
