@extends('data_pelanggan.dashboard.layout')

@section('content')

<div class="col-md-12 col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title text-center">Daftar Pembayaran Pelanggan</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Status</th>
                                <th>Jenis Pembayaran</th>
                                <th>Waktu Pembayaran</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listPembayaran as $pembayaran)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pembayaran->status }}</td>
                                    <td>{{ $pembayaran->payment_type }}</td>
                                    <td>{{ $pembayaran->transaction_time }}</td>
                                    <td>{{ $pembayaran->total}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
