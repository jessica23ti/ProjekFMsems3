@extends('layoutUser.temp')
@section('content')

@section('hero-title')
    Detail Bayar
@endsection

{{-- Menampilkan total_item_pesanan --}}
<p>Total Item Pesanan: {{ $transaksi['total_item_pesanan'] }}</p>

{{-- Menampilkan total_biaya --}}
<p>Total Biaya: {{ $transaksi['total_biaya'] }}</p>

{{-- Menampilkan user_id --}}
<p>User ID: {{ $transaksi['user_id'] }}</p>

{{-- Menampilkan status_pesan --}}
<p>Status Pesan: {{ $transaksi['status_pesan'] }}</p>

{{-- @foreach ($transaksi as $trs)
    {{ $trs->total_item_pesanan }}
    {{ $trs->total_item_pesanan }}
@endforeach --}}
@endsection

