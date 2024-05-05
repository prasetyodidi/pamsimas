<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pelanggan;

class datapelangganController extends Controller
{
    public function index() 
    {
        $pelanggans = Pelanggan::all();
        return view('data_pelanggan.index', compact('pelanggans'));
    }

    public function create()
    {
        return view ('data_pelanggan.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([

            'nama' => 'string|required',
            'alamat' => 'string|required',
            'no_pelanggan' => 'string|required|unique:pelanggans'

        ]);

        $pelanggan = Pelanggan::create($validateData);

        if ($pelanggan){
            return to_route('datapelanggan.index')->with('success', 'Berhasil Menambah Data');
        }else{
            return to_route('datapelanggan.index')->with('failed', 'Gagal Menambah Data');
        }
    }

    public function edit(Pelanggan $pelanggan)
    {
        // $pelanggan = Pelanggan::all();
        return view('data_pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $validateData = $request->validate([

            'nama' => 'string|required',
            'alamat' => 'string|required',
            'no_pelanggan' => 'string|required|unique:pelanggans,no_pelanggan,'. $pelanggan->id

        ]);

        $pelanggan->update($validateData);

        if ($pelanggan){
            return to_route('datapelanggan.index')->with('success', 'Berhasil Mengubah Data');
        }else{
            return to_route('datapelanggan.index')->with('failed', 'Gagal Mengubah Data');
        }
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        if ($pelanggan){
            return to_route('datapelanggan.index')->with('success', 'Berhasil Meenghapus Data');
        }else{
            return to_route('datapelanggan.index')->with('failed', 'Gagal Menghapus Data');
        }
    }

}
