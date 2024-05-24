<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    public function index(){
        $totalPelanggan = Pelanggan::count();
        $totalPembayaran = Pembayaran::query()->where('status', 'capture')->get();
        $user = Auth::user();
        return view('dashboard.dashboard', compact('totalPelanggan', 'totalPembayaran', 'user'));
    }
}
