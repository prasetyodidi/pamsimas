<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pelanggan extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $lable = "pelanggans";
    protected $fillable = ['nama', 'alamat', 'no_pelanggan', 'password'];
    protected $guard = 'pelanggan';

    protected function password(): Attribute {
        return Attribute::make(
            set: fn (string $value) => Hash::make($value)
        );
    }

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
