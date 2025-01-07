<!DOCTYPE html>
<html>

<head>
    <title>Konfirmasi Pembelian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            color: #820901;
        }
    </style>
</head>

<body>
    <h1>{{ $data['text'] }}</h1>
    <p>Pesanan Anda telah berhasil diproses.</p>
    <p>Berikut adalah detail pesanan Anda : .</p>
    <p>Nomor Pesanan: <strong>{{ $data['order_id'] }}</strong></p>
    <p>Tanggal Pemesanan: <strong>{{ $data['tgl'] }}</strong></p>

    <p>Terima kasih telah berbelanja di toko kami!</p>
    <hr>
    <p><small>Email ini dikirim secara otomatis. Mohon tidak membalas email ini.</small></p>
</body>

</html>
