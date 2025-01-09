<!DOCTYPE html>
<html>

<head>
    <title>Konfirmasi Pembelian</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        .container {
            width: 80%;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #820901;
            text-align: center;
            font-size: 24px;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
        }

        .details {
            margin-top: 20px;
            border-top: 2px solid #820901;
            padding-top: 20px;
        }

        .details p {
            margin: 8px 0;
        }

        .details strong {
            color: #333333;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #777;
        }

        .footer small {
            font-style: italic;
        }

        .button {
            display: inline-block;
            background-color: #820901;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #b33a3a;
        }
    </style>
</head>

<body>
    <div class="container">
        @php
            use Carbon\Carbon;
        @endphp

        <h1>{{ $data['text'] }}</h1>
        <p>Pesanan Anda telah berhasil diproses. Berikut adalah detail pesanan Anda:</p>

        <div class="details">
            <p>Nomor Pesanan: <strong>{{ $data['order_id'] }}</strong></p>
            <p>Total Belanja: <strong>Rp {{ number_format($data['total'], 0, ',', '.') }}</strong></p>
            <p>Total Item: <strong>{{ $data['total_item'] }}</strong></p>
            <p>Tanggal Pemesanan:
                <strong>{{ \Carbon\Carbon::parse($data['tgl'])->translatedFormat(' d F Y') }}</strong>
            </p>
        </div>

        <p>Terima kasih telah berbelanja di toko kami!</p>

        {{-- <a href="#" class="button">Lihat Pesanan</a> --}}
    </div>

    <div class="footer">
        <p><small>Email ini dikirim secara otomatis. Mohon tidak membalas email ini.</small></p>
    </div>
</body>

</html>
