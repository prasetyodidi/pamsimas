<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory, HasUuids;

    protected $lable = "tagihans";
    protected $fillable = ['id_pelanggan', 'periode', 'jml_pemakaian', 'total'];
}
