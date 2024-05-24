<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .receipt-container {
            width: 1000px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .receipt-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .receipt-header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .receipt-header p {
            margin-bottom: 0;
        }

        .receipt-body {
            font-size: 16px;
        }

        .receipt-items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .receipt-items th,
        .receipt-items td {
            padding: 5px;
            border: 1px solid #ddd;
        }

        .receipt-items th {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="receipt-container">
        <div class="receipt-header">
            <h1>Pamsimas</h1>
        </div>
        <div class="receipt-body">
            <h2>Bukti Bayar</h2>
            <p>Nama Pelanggan: <span id="customer-name">{{ $tagihan->pelanggan->nama }}</span></p>
            <p>No Pelanggan: <span id="customer-number">{{ $tagihan->pelanggan->nama }}</span></p>
            <p>Total: <span>{{ $tagihan->total }}</span></p>
            <p>Status: <span>{{ $tagihan->pembayaran->status == 'capture' ? 'LUNAS' : 'BELUM LUNAS' }}</span></p>
        </div>
    </div>
</body>

</html>
