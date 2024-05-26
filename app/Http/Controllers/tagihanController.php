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
        $daftarPelanggan = Pelanggan::get();
        return view('tagihan.create', compact('daftarPelanggan'));
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

        if ($tagihan) {
            return to_route('tagihan.index')->with('success', 'Berhasil Menambah Data');
        } else {
            return to_route('tagihan.index')->with('failed', 'Gagal Menambah Data');
        }
    }

    public function edit(Request $request, string $id)
    {
        $tagihan = Tagihan::find($id);
        $daftarPelanggan = Pelanggan::get();

        return view('tagihan.edit', compact('daftarPelanggan', 'tagihan'));
    }

    public function update(Request $request, string $id)
    {

        $validateData = $request->validate([
            'no_pelanggan' => 'string|required',
            'periode' => 'string|required',
            'jml_pemakaian' => 'string|required',
            'total' => 'string|required'

        ]);

        // dd($validateData);

        $pelanggan = Pelanggan::query()->where('no_pelanggan', $validateData['no_pelanggan'])->first();

        $dataTagihan = [
            'id_pelanggan' => $pelanggan->id,
            'periode' => $validateData['periode'],
            'jml_pemakaian' => $validateData['jml_pemakaian'],
            'total' => $validateData['total'],
        ];

        $tagihan = Tagihan::query()->where('id', $id)->update($dataTagihan);

        if ($tagihan) {
            return to_route('tagihan.index')->with('success', 'Berhasil Mengubah Data');
        } else {
            return to_route('tagihan.index')->with('failed', 'Gagal Mengubah Data');
        }
    }

    public function destroy(Tagihan $tagihan)
    {
        $tagihan->delete();
        if ($tagihan) {
            return to_route('tagihan.index')->with('success', 'Berhasil Meenghapus Data');
        } else {
            return to_route('tagihan.index')->with('failed', 'Gagal Menghapus Data');
        }
    }

    public function cariTagihan(Request $request)
    {
        $noPelanggan = $request->no_pelanggan;
        if ($request->no_pelanggan != null) {
            $pelanggan = Pelanggan::query()->where('no_pelanggan', $request->no_pelanggan)->first();
            if ($pelanggan == null) {
                $listTagihan = null;
            } else {
                $listTagihan = Tagihan::query()->where('id_pelanggan', $pelanggan->id)->doesntHave('pembayaran')->get();
            }
        } else {
            $listTagihan = Tagihan::query()->doesntHave('pembayaran')->get();
        }

        return view('tagihan.cari', compact('listTagihan', 'noPelanggan'));
    }
}
