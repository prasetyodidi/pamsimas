<?php

namespace App\Exports;

use App\Models\Tagihan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TagihansExport implements FromView
{
    public function view(): View
    {
        return view('exports.laporan', [
            'laporans' => Tagihan::with('pembayaran')->get()
        ]);
    }

    // public function collection()
    // {
    //     return Tagihan::all();
    // }
}
