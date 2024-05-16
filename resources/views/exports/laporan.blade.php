<table>
    <thead>
    <tr>
        <th>No Pelangan</th>
        <th>Periode</th>
        <th>Pemakaian</th>
        <th>Total</th>
        <th>Status Pembayaran</th>
        <th>Tanggal Pembayaran</th>
    </tr>
    </thead>
    <tbody>
    @foreach($laporans as $laporan)
        <tr>
            <td>{{ $laporan->pelanggan->no_pelanggan }}</td>
            <td>{{ $laporan->periode }}</td>
            <td>{{ $laporan->jml_pemakaian }}</td>
            <td>{{ $laporan->total }}</td>
            <td>{{ $laporan->pembayaran->status ?? 'belum dibayar' }}</td>
            <td>{{ $laporan->pembayaran->transaction_time ?? 'belum dibayar' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
