<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tagihans = Tagihan::with('pembayaran')->get();
        return view('laporan.index', compact('tagihans'));
    }
}
