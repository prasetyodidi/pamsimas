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
                                <a href="{{ route('laporan.export.excel') }}" class="btn btn-success">Excel</a>
                                <a href="{{ route('laporan.export.pdf') }}" class="btn btn-danger">PDF</a>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Pelanggan</th>
                                            <th>Periode</th>
                                            <th>Pemakaian</th>
                                            <th>Total</th>
                                            <th>Status Pembayaran</th>
                                            <th>Tanggal Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tagihans as $tagihan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $tagihan->pelanggan->no_pelanggan }}</td>
                                                <td>{{ $tagihan->periode }}</td>
                                                <td>{{ $tagihan->jml_pemakaian }}</td>
                                                <td>{{ $tagihan->total }}</td>
                                                <td>{{ $tagihan->pembayaran->status ?? 'belum dibayar' }}</td>
                                                <td>{{ $tagihan->pembayaran->transaction_time ?? 'belum dibayar' }}</td>
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
