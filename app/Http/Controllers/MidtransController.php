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
    public function checkout(Request $request, String $id)
    {
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

        $pembayaran = Pembayaran::query()->find($tagihan->id);

        if ($pembayaran != null) {
            return redirect($pembayaran->snap_url);
        }

        try {
            $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;

            $dataPembayaran = [
                'id' => $tagihan->id,
                'id_pelanggan' => $pelanggan->id,
                'total' => $tagihan->total,
                'status' => 'pending',
                'snap_url' => $paymentUrl,
            ];
            Pembayaran::query()->create($dataPembayaran);

            Log::info($paymentUrl, ['type' => 'midtrans:payment url']);

            return redirect($paymentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function paymentNotification(Request $request)
    {
        Log::info($request, ['type' => 'midtrans:payment notification']);

        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            $pembayaran = Pembayaran::query()->find($request->order_id);

            $pembayaran->status = $request->transaction_status;
            $pembayaran->payment_type = $request->payment_type;
            $pembayaran->transaction_time = $request->transaction_time;
            $pembayaran->save();
            if ($request->transaction_status == 'capture') {
                if ($request->fraud_status == 'accept') {
                    // TODO set transaction status on your database to 'success'
                    // and response with 200 OK
                    Log::info('capture and accept', ['type' => 'midtrans:payment status', 'order_id id' => $request->order_id]);
                }
            } else if ($request->transaction_status == 'settlement') {
                // TODO set transaction status on your database to 'success'
                // and response with 200 OK
                Log::info('settlement', ['type' => 'midtrans:payment status', 'order_id id' => $request->order_id]);
            } else if (
                $request->transaction_status == 'cancel' ||
                $request->transaction_status == 'deny' ||
                $request->transaction_status == 'expire'
            ) {
                // TODO set transaction status on your database to 'failure'
                // and response with 200 OK
                Log::info('cancel, deny, or expire', ['type' => 'midtrans:payment status', 'order_id id' => $request->order_id]);
            } else if ($request->transaction_status == 'pending') {
                // TODO set transaction status on your database to 'pending' / waiting payment
                // and response with 200 OK
                Log::info('pending', ['type' => 'midtrans:payment status', 'order_id id' => $request->order_id]);
            }
        }

        return response()->json(['ok!']);
    }
}
