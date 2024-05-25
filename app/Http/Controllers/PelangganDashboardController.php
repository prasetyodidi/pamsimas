<?php

namespace App\Http\Controllers;

use App\Exports\BuktiBayarExport;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PelangganDashboardController extends Controller
{
    public function index(Request $request)
    {

        return view('data_pelanggan.dashboard.index');
    }

    function tagihan(Request $request)
    {
        $pelanggan = Auth::guard('pelanggan')->user();

        $listTagihan = Tagihan::query()->where('id_pelanggan', $pelanggan->id)->get();
        return view('data_pelanggan.dashboard.tagihan', compact('listTagihan'));
    }

    function pembayaran(Request $request)
    {
        $pelanggan = Auth::guard('pelanggan')->user();

        $listPembayaran = Pembayaran::query()->where('id_pelanggan', $pelanggan->id)->get();
        return view('data_pelanggan.dashboard.pembayaran', compact('listPembayaran'));
    }

    public function exportPdf(Request $request, string $id)
    {
        $fileName = 'pembayaran_' . $id . '.pdf';
        return Excel::download(new BuktiBayarExport($id), $fileName, \Maatwebsite\Excel\Excel::DOMPDF);
    }
}
