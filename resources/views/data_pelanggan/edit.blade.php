@extends('kerangka.master')

@section('content')

<div class="col-md-12 col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title text-center"> Update Data Pelanggan</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-horizontal" method="POST" action="{{ route('datapelanggan.update', $pelanggan->id) }}">
                    @csrf
                    @method('patch')
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Nama</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="nama" name="nama" 
                                    class="form-control @error('nama') is invalid 
                                @enderror" 
                                    value="{{ old('nama') ?? $pelanggan->nama }}" placeholder="Nama">
                                @error('nama')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Alamat</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="alamat" name="alamat" 
                                    class="form-control @error('alamat') is invalid 
                                @enderror" 
                                    value="{{ old('alamat') ?? $pelanggan->alamat }}" placeholder="Alamat">
                                @error('alamat')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Nomor Pelanggan</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="no_pelanggan" name="no_pelanggan" 
                                    class="form-control @error('no_pelanggan') is invalid 
                                @enderror" 
                                    value="{{ old('no_pelanggan') ?? $pelanggan->no_pelanggan }}" placeholder="Nomor Pelanggan">
                                @error('no_pelanggan')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                <button type="reset"
                                    class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection