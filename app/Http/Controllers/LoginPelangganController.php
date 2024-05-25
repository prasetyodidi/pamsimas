<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginPelangganController extends Controller
{
    public function show(Request $request)
    {
        return view('data_pelanggan.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'no_pelanggan' => ['required'],
            'password' => ['required']
        ]);

        $pelanggan = Pelanggan::query()->where('no_pelanggan', $credentials['no_pelanggan'])->first();

        if (Auth::guard('pelanggan')->attempt($credentials)) {
            return redirect()->route('plg.dash.tagihan');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }
}
