<?php

namespace App\Http\Controllers;

use App\Exports\TagihansExport;
use App\Models\Pelanggan;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tagihans = Tagihan::with('pembayaran')->get();
        return view('laporan.index', compact('tagihans'));
    }

    public function excelExport(Request $request)
    {
        return Excel::download(new TagihansExport, 'laporan.xlsx');
    }

    public function pdfExport(Request $request)
    {
        return Excel::download(new TagihansExport, 'laporan.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }
}
