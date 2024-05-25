<?php

namespace App\Exports;

use App\Models\Tagihan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BuktiBayarExport implements FromView
{
    private string $tagihanId;

    public function __construct(string $tagihanId)
    {
        $this->tagihanId = $tagihanId;
    }

    public function view(): View
    {
        return view('exports.bukti_bayar', [
            'tagihan' => Tagihan::with('pembayaran')->where('id', $this->tagihanId)->first()
        ]);
    }
}
