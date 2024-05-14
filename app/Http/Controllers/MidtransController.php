<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    public function checkout(Request $request, String $id) {
        $tagihan = Tagihan::query()->findOrFail($id);
        $pelanggan = Auth::guard('pelanggan')->user();

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

        $params = [
            'transaction_details' => [
                'order_id' => $tagihan->id,
                'gross_amount' => $tagihan->total
            ],
        ];

        try {
            $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;

            $dataPembayaran = [
                'id' => $tagihan->id,
                'pelanggan_id' => $pelanggan->id,
                'total' => $tagihan->total,
            ];
            Pembayaran::query()->create($dataPembayaran);

            Log::info($paymentUrl, ['type' => 'midtrans:payment url']);

            return redirect($paymentUrl);
          }
          catch (Exception $e) {
            echo $e->getMessage();
          }
    }

    function paymentNotification(Request $request)
    {
        Log::info($request, ['type' => 'midtrans:payment notification']);

        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            if ($request->transactionStatus == 'capture') {
                if ($request->fraudStatus == 'accept') {
                    // TODO set transaction status on your database to 'success'
                    // and response with 200 OK
                    Log::info('capture and accept', ['type' => 'midtrans:payment status']);

                }
            } else if ($request->transactionStatus == 'settlement') {
                // TODO set transaction status on your database to 'success'
                // and response with 200 OK
                Log::info('settlement', ['type' => 'midtrans:payment status']);
            } else if (
                $request->transactionStatus == 'cancel' ||
                $request->transactionStatus == 'deny' ||
                $request->transactionStatus == 'expire'
            ) {
                // TODO set transaction status on your database to 'failure'
                // and response with 200 OK
                Log::info('cancel, deny, or expire', ['type' => 'midtrans:payment status']);
            } else if ($request->transactionStatus == 'pending') {
                // TODO set transaction status on your database to 'pending' / waiting payment
                // and response with 200 OK
                Log::info('pending', ['type' => 'midtrans:payment status']);
            }
        }

        return response()->json(['ok!']);
    }
}
