<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tagihan extends Model
{
    use HasFactory, HasUuids;

    protected $lable = "tagihans";
    protected $fillable = ['id_pelanggan', 'periode', 'jml_pemakaian', 'total'];

    public function pembayaran(): HasOne {
        return $this->hasOne(Pembayaran::class, 'id', 'id');
    }

    public function pelanggan(): BelongsTo {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id');
    }
}
