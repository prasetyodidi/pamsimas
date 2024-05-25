<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    public function index()
    {
        $totalPelanggan = Pelanggan::count();
        $totalTagihan = Tagihan::query()->count();
        $totalTagihanDibayar = Pembayaran::query()->where('status', 'capture')->count();
        $totalUangMasuk = Pembayaran::query()->where('status', 'capture')->sum('total');
        $totalTagihanBelumBayar = $totalTagihan - $totalTagihanDibayar;

        $user = Auth::user();

        return view('dashboard.dashboard', compact( 'user', 'totalPelanggan', 'totalTagihanDibayar', 'totalUangMasuk', 'totalTagihanBelumBayar',));
    }
}
