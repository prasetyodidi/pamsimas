<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $lable = "tagihans";
    protected $fillable = ['no_pelanggan', 'periode', 'jml_pemakaian', 'total'];
}
