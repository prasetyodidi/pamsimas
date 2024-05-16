<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pembayaran extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pelanggan() : BelongsTo {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id');
    }

    public function tagihan(): BelongsTo {
        return $this->belongsTo(Tagihan::class, 'id', 'id');
    }
}
