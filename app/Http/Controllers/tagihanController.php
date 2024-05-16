<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class tagihanController extends Controller
{
    public function index()
    {
        $tagihans = Tagihan::all();
        return view('tagihan.index', compact('tagihans'));
    }

    public function create()
    {
        return view('tagihan.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'no_pelanggan' => 'string|required',
            'periode' => 'string|required',
            'jml_pemakaian' => 'string|required',
            'total' => 'string|required'

        ]);

        $pelanggan = Pelanggan::query()->where('no_pelanggan', $validateData['no_pelanggan'])->first();

        $dataTagihan = [
            'id_pelanggan' => $pelanggan->id,
            'periode' => $validateData['periode'],
            'jml_pemakaian' => $validateData['jml_pemakaian'],
            'total' => $validateData['total'],
        ];

        $tagihan = Tagihan::create($dataTagihan);

            if ($tagihan){
                return to_route('tagihan.index')->with('success', 'Berhasil Menambah Data');
            }else{
                return to_route('tagihan.index')->with('failed', 'Gagal Menambah Data');
            }

    }

    public function edit()
    {
        return view('tagihan.edit');
    }

    public function destroy(Tagihan $tagihan)
    {
        $tagihan->delete();
        if ($tagihan){
            return to_route('tagihan.index')->with('success', 'Berhasil Meenghapus Data');
        }else{
            return to_route('tagihan.index')->with('failed', 'Gagal Menghapus Data');
        }
    }

    public function cariTagihan(Request $request) {
        if ($request->no_pelanggan != null) {
            $pelanggan = Pelanggan::query()->where('no_pelanggan', $request->no_pelanggan)->first();
            $listTagihan = Tagihan::query()->where('id_pelanggan', $pelanggan->id)->doesntHave('pembayaran')->get();
        } else {
            $listTagihan = Tagihan::query()->doesntHave('pembayaran')->get();
        }

        return view('tagihan.cari', compact('listTagihan'));
    }

}
