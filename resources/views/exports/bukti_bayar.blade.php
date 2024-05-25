<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .invoice-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .invoice-header {
            text-align: center;
            padding-bottom: 20px;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }

        .invoice-header h1 {
            font-size: 28px;
            margin-bottom: 5px;
            color: #333;
        }

        .invoice-header p {
            margin: 0;
            color: #666;
        }

        .invoice-body {
            font-size: 16px;
            color: #333;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-table th,
        .invoice-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .invoice-footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
        }

        .status-paid {
            color: green;
            font-weight: bold;
        }

        .status-unpaid {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <h1>Pamsimas</h1>
            <p>Alamat: Jl. Contoh No. 123, Jakarta | Telepon: (021) 123456</p>
        </div>
        <div class="invoice-body">
            <h2 style="text-align: center;">Bukti Bayar</h2>
            <table class="invoice-table" style="margin: 0 auto;">
                <tr>
                    <th style="text-align: right;">Nama Pelanggan:</th>
                    <td>{{ $tagihan->pelanggan->nama }}</td>
                    <th style="text-align: right;">No Pelanggan:</th>
                    <td>{{ $tagihan->pelanggan->no_pelanggan }}</td>
                </tr>
                <tr>
                    <th style="text-align: right;">Periode:</th>
                    <td>{{ $tagihan->periode }}</td>
                    <th style="text-align: right;">Jumlah Pemakaian:</th>
                    <td>{{ $tagihan->jml_pemakaian }}</td>
                </tr>
                <tr>
                    <th style="text-align: right;">Total:</th>
                    <td colspan="3">{{ number_format($tagihan->total, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th style="text-align: right;">Status:</th>
                    <td colspan="3"
                        style="color: {{ $tagihan->pembayaran->status == 'capture' ? 'green' : 'red' }}; font-weight: bold;">
                        {{ $tagihan->pembayaran->status == 'capture' ? 'LUNAS' : 'BELUM LUNAS' }}</td>
                </tr>
            </table>
        </div>
        <div class="invoice-footer">
            <p>Terima kasih telah melakukan pembayaran.</p>
        </div>
    </div>
</body>

</html>
