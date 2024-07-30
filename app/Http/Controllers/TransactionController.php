<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {

        $transactions = Transaction::where('user_id', Auth::user()->id)->get();

        $transactions->transform(function ($transaction, $key) {
            $transaction->product = collect(config('products'))->firstWhere('id', $transaction->product_id);
            return $transaction;
        });


        return view('transactions', compact('transactions'));
    }


    public function cancel($id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->status = 'failed';
        $transaction->save();

        
        return redirect()->route('transactions')->with('success', 'Transaksi berhasil dibatalkan');
    }

    public function destroy($id)
    {
        $transaction = Transaction::find($id);

        if ($transaction) {
            $transaction->delete();

            return redirect()->route('transactions')
                ->with('success', 'Transaksi berhasil dihapus.');
        } else {
            return redirect()->route('transactions')
                ->with('error', 'Transaksi tidak ditemukan.');
        }
    }
}
