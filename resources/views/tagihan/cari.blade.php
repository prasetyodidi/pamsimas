@extends('kerangka.master')
@section('content')
    <!-- Basic Tables start -->
    <section class="section">
        <div class="row" id="basic-table">
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Laporan</h4>

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
                            <div class="table-responsive">
                                <form action="{{ route('tagihan.cari') }}" method="get">
                                    <div class="input-group mb-3">
                                        <input type="text" id="no_pelanggan" name="no_pelanggan"
                                            placeholder="no pelanggan" />
                                        <button type="submit" class="btn btn-primary">Cari</button>
                                    </div>
                                </form>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Pelanggan</th>
                                            <th>Periode</th>
                                            <th>Pemakaian</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listTagihan as $pembayaran)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pembayaran->pelanggan->no_pelanggan }}</td>
                                                <td>{{ $pembayaran->periode }}</td>
                                                <td>{{ $pembayaran->jml_pemakaian }}</td>
                                                <td>{{ $pembayaran->total }}</td>
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
