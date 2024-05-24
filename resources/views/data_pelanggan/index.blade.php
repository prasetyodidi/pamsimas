@extends('kerangka.master')
@section('content')

<!-- Basic Tables start -->
<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-center">Data Pelanggan</h4>
                    <a class="btn btn-primary" href="{{ route('pelanggan.create') }}">Tambah Baru</a>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                    @elseif (session()->has('failed'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('failed') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                @endif
                <div class="card-content">
                    <div class="card-body">

                        <!-- Table with outer spacing -->
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>No Pelanggan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pelanggans as $pelanggan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pelanggan->nama }}</td>
                                            <td>{{ $pelanggan->alamat }}</td>
                                            <td>{{ $pelanggan->no_pelanggan }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a class="btn btn-warning mx-1" href="{{ route('pelanggan.edit', $pelanggan->id) }}">Update</a>
                                                    <form action="{{ route('pelanggan.destroy', $pelanggan->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Basic Tables end -->

@endsection
