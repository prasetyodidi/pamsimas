<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggans = Pelanggan::all();
        return view('data_pelanggan.index', compact('pelanggans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('data_pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'string|required',
            'alamat' => 'string|required',
            'no_pelanggan' => 'string|required|unique:pelanggans',
            'password' => 'string',
        ]);

        $pelanggan = Pelanggan::create($validateData);

        if ($pelanggan){
            return to_route('pelanggan.index')->with('success', 'Berhasil Menambah Data');
        }else{
            return to_route('pelanggan.index')->with('failed', 'Gagal Menambah Data');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelanggan $pelanggan)
    {
        // $pelanggan = Pelanggan::all();
        return view('data_pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        $validateData = $request->validate([

            'nama' => 'string|required',
            'alamat' => 'string|required',
            'no_pelanggan' => 'string|required|unique:pelanggans,no_pelanggan,'. $pelanggan->id

        ]);

        $pelanggan->update($validateData);

        if ($pelanggan){
            return to_route('pelanggan.index')->with('success', 'Berhasil Mengubah Data');
        }else{
            return to_route('pelanggan.index')->with('failed', 'Gagal Mengubah Data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        if ($pelanggan){
            return to_route('pelanggan.index')->with('success', 'Berhasil Meenghapus Data');
        }else{
            return to_route('pelanggan.index')->with('failed', 'Gagal Menghapus Data');
        }
    }
}
