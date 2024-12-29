@extends('layoutUser.temp', ['title' => 'Bayar'])
@section('content')
@section('hero-title')
    Bayar
@endsection

@php
    $subTotal = 0; // Inisialisasi subtotal
@endphp

<div class="untree_co-section">
    <div class="container">
        <br><br>
        <div class="col-md-12">
            <div class="mb-5 row">
                <div class="col-md-12">
                    <h2 class="mb-3 text-black h3">Your Order</h2>
                    <div class="bg-white p-3 p-lg-5 border">
                        <table class="site-block-order-table mb-5 table">
                            <thead>
                                <th>Product</th>
                                <th>Total</th>
                            </thead>
                            <tbody>
                                @if (isset($cart))
                                    @foreach ($cart as $kiw)
                                        <tr>

                                            <td>{{ $kiw->produk->nama }}<strong
                                                    class="mx-2">x</strong>{{ $kiw->quantity }}</td>
                                            <td>{{ $kiw->produk->harga * $kiw->quantity }}</td>
                                            @php
                                                $subTotal += $kiw->produk->harga * $kiw->quantity;
                                            @endphp
                                        </tr>
                                    @endforeach
                                @endif
                                <tr>
                                    <td class="font-weight-bold text-black"><strong>Cart Subtotal</strong></td>
                                    <td class="text-black">{{ $subTotal }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="form-group">
                            <button class="btn-block py-3 btn btn-black btn-lg" id="placeOrderBtn" type="button">Place
                                Order</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Include jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function() {
                // Mengirim data cart ke controller saat tombol Place Order diklik
                $('#placeOrderBtn').click(function() {
                    var cartData = [];

                    // Mengambil ID produk dari cart dan menyimpannya dalam array
                    @foreach ($cart as $kiw)
                        cartData.push({
                            id: '{{ $kiw->id }}',
                            harga: '{{ $kiw->produk->harga }}',
                            name: '{{ $kiw->produk->nama }}',
                            total: '{{ $kiw->produk->harga * $kiw->quantity }}',
                            quantity: '{{ $kiw->quantity }}'
                        });
                    @endforeach

                    $.ajax({
                        url: '{{ route('Payment') }}', // URL ke controller untuk memproses order
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            cart: cartData, // Kirim data cart yang telah diubah menjadi array
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Order Successfully',
                                text: response.message, // Pesan sukses dari server
                            }).then(function() {
                                var redirectUrl = response.redirect_url;
                                window.location.href =
                                    redirectUrl; // Redirect ke URL yang diterima
                            });
                        },
                        error: function(xhr, status, error) {
                            console.log("Error details:", error); // Menampilkan pesan error
                            console.log("Status:",
                                status); // Status dari request (misalnya 'timeout', 'error', dll.)
                            console.log("Response:", xhr
                                .responseText); // Respons dari server yang lebih lengkap jika ada
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'There was an error while processing your order.',
                            });
                        }
                    });
                });
            });
        </script>




    </div>
</div>

@endsection
