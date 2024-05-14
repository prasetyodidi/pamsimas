<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelangganDashboardController extends Controller
{
    public function index(Request $request) {

        return view('data_pelanggan.dashboard.index');
    }

    function tagihan(Request $request) {
        $pelanggan = Auth::guard('pelanggan')->user();

        $listTagihan = Tagihan::query()->where('id_pelanggan', $pelanggan->id_pelanggan)->get();
        dd([$pelanggan, $listTagihan]);
        return view('data_pelanggan.dashboard.tagihan', compact('listTagihan'));
    }
}
