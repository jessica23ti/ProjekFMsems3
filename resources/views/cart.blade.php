@extends('layoutUser.temp', ['title' => 'Cart UMKM '])
@section('content')
@section('hero-title')
    Keranjang
@endsection

<div class="untree_co-section before-footer-section">

    <div class="container">
        <h1 style="margin-left: 70px;margin-top: 0px;color: black;font-size:50px" class="d-block">Cart</h1>
        <div class="row mb-5">
            <div class="site-blocks-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th> <input type="checkbox" id="checkAll">
                            </th>
                            <th class="product-thumbnail">Image</th>
                            <th class="product-name">Product</th>
                            <th class="product-price">Price</th>
                            <th class="product-quantity">Quantity</th>
                            <th class="product-total">Total</th>
                            <th class="product-remove">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $carts)
                            <tr>
                                <td>
                                    <input type="checkbox" name="selected_items[]" value="{{ $carts->id }}"
                                        class="check-item" id="ids">
                                </td>
                                @php
                                    $image = $carts->produk->images->first();
                                @endphp

                                <td class="product-thumbnail">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="IMG-PRODUCT"
                                        class="img-fluid">
                                </td>
                                <td class="product-name">
                                    <h2 class="h5 text-black">{{ $carts->produk->nama }}</h2>
                                </td>
                                <td>{{ $carts->produk->harga }}</td>
                                <td>
                                    <div class="input-group mb-3 d-flex align-items-center quantity-container"
                                        style="max-width: 120px;">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-black decrease"
                                                type="button">&minus;</button>
                                        </div>
                                        <input type="text" class="form-control text-center quantity-amount"
                                            value="{{ $carts->quantity }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-black increase"
                                                type="button">&plus;</button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $total = $carts->quantity * floatval($carts->produk->harga);
                                    @endphp
                                    {{ $total }}
                                </td>
                                <td>
                                    <form id="delete-item-{{ $carts->id }}"
                                        action="{{ route('cart.delete', $carts->id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <a href="#" onclick="confirmDelete({{ $carts->id }})"
                                        class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row mb-5">
                    <div class="col-md-6">
                        <a href="{{ route('Produk.index') }}" class="btn btn-outline-black btn-sm btn-block">Continue
                            Shopping</a>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <!-- Form untuk Checkout -->
                <form action="{{ route('checkout') }}" method="POST" id="checkoutForm">
                    @csrf
                    <!-- Input Hidden untuk Mengirim ID Produk yang Dipilih -->
                    <input type="hidden" name="selected_items" id="selectedItemsInput">

                    <button class="btn btn-black btn-lg py-3 btn-block" type="submit">
                        Proceed To Checkout
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        // Event untuk checkbox "Check All"
        $("#checkAll").click(function() {
            $(".check-item").prop("checked", this
                .checked); // Semua checkbox mengikuti status "Check All"
        });

        // Event untuk mengupdate status "Check All" berdasarkan checkbox individual
        $(".check-item").click(function() {
            if ($(".check-item:checked").length === $(".check-item").length) {
                $("#checkAll").prop("checked",
                    true); // Jika semua checkbox tercentang, "Check All" ikut tercentang
            } else {
                $("#checkAll").prop("checked",
                    false); // Jika ada yang tidak tercentang, "Check All" tidak tercentang
            }
        });

        // Ketika tombol "Proceed To Checkout" ditekan
        $('#checkoutForm').submit(function() {
            // Ambil semua checkbox yang tercentang
            var selectedItems = [];
            $("input[name='selected_items[]']:checked").each(function() {
                selectedItems.push($(this).val()); // Ambil value dari checkbox yang tercentang
            });

            // Cek apakah ada item yang dipilih
            if (selectedItems.length > 0) {
                // Masukkan data ke input hidden
                $('#selectedItemsInput').val(JSON.stringify(selectedItems)); // Mengirim data terpilih

                return true; // Lanjutkan form submit
            } else {
                // Jika tidak ada item yang dipilih, tampilkan alert
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Pilih item untuk melanjutkan ke checkout!',
                });
                return false; // Batalkan submit jika tidak ada item yang dipilih
            }
        });
    });
</script>
@endsection
