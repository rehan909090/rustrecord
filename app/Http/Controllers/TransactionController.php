<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function showTicket($order_id)
    {
        // Mencari transaksi berdasarkan order_id
        $transaction = Transaction::where('order_id', $order_id)->first();
    
        // Jika transaksi tidak ditemukan, kembalikan pesan error
        if (!$transaction) {
            return redirect()->route('concerts.index')->with('error', 'Transaksi tidak ditemukan');
        }
    
        // Kembalikan view dengan data transaksi
        return view('ticket.show', compact('transaction'));
    }
    

}
