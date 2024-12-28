@extends('layoutUser.tempDasar', ['title' => 'Shop UMKM'])
@section('content')
@section('hero-title')
    Shop UMKM Indonesia
@endsection

<!-- Product Detail -->
<section class="sec-product-detail bg0 p-t-65 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-7 p-b-30">
                <div class="p-l-25 p-r-30 p-lr-0-lg coy">
                    <div class="wrap-slick3 flex-sb flex-w">
                        <div class="wrap-slick3-dots"></div>
                        <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
                        @php
                            // Mengambil gambar pertama jika ada
                            $image = $produk->images->first();
                        @endphp
                        <div class="slick3 gallery-lb">
                            @foreach ($produk as $item)
                                <div class="item-slick3" data-thumb="images/product-detail-01.jpg">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="IMG-PRODUCT">
                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                            href="#">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-5 p-b-30">
                <div class="p-r-50 p-t-5 p-lr-0-lg">
                    <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                        {{ ucwords($produk->nama) }}
                    </h4>
                    <span class="mtext-106 cl2">
                        <table class="table">
                            <tr>
                                <td>
                                    Price: Rp.{{ $produk->harga }} <br>
                                </td>
                            </tr>
                            <tr>
                                <td> Ukuran : {{ $produk->ukuran }}<br></td>
                            </tr>
                            <tr>
                                <td> Diskon : {{ $produk->diskon }}</td>
                            </tr>
                        </table>



                    </span>

                    <p class="stext-102 cl3 p-t-23">
                        Deskripsi : {{ $produk->deskripsi }}

                    </p>

                    <!--  -->
                    <div class="p-t-33">
                        <div class="flex-w flex-r-m p-b-10">

                            <div class="size-204 flex-w flex-m respon6-next">
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <!-- CSRF Token untuk keamanan -->
                                    <!-- Input jumlah produk -->
                                    <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fas fa-minus"></i>
                                        </div>

                                        <input class="mtext-104 cl3 txt-center num-product" type="number"
                                            name="quantity" value="1" min="1">

                                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="{{ $produk->id }}">

                                    <!-- Tombol Add to Cart -->
                                    <button type="submit"
                                        class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                        Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!--  -->
                    <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                        <div class="flex-m bor9 p-r-10 m-r-11">
                            <a href="#"
                                class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100"
                                data-tooltip="Add to Wishlist">
                                <i class="zmdi zmdi-favorite"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bor10 m-t-50 p-t-43 p-b-40">
            <!-- Tab01 -->
            <div class="tab01">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item p-b-10">
                        <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
                    </li>

                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-t-43">
                    <!-- - -->
                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                        <div class="how-pos2 p-lr-15-md">
                            <p class="stext-102 cl6">
                                {{ $produk->deskripsi }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('.slick3').slick({
            slidesToShow: 1, // Jumlah slide yang ditampilkan
            slidesToScroll: 1, // Jumlah slide yang digeser per klik
            arrows: true, // Tombol panah (sembunyikan jika tidak diperlukan)
            dots: true, // Menampilkan navigasi dot di bawah
            infinite: true, // Looping terus
            autoplay: true, // Slide otomatis
            autoplaySpeed: 3000, // Kecepatan autoplay (dalam milidetik, 3000 = 3 detik)
            adaptiveHeight: true // Menyesuaikan tinggi slide
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        // Tombol minus
        $('.btn-num-product-down').on('click', function() {
            var input = $(this).siblings('input.num-product');
            var value = parseInt(input.val()); // Ambil nilai saat ini
            if (value > 0) {
                input.val(value - 1); // Kurangi nilai 1 jika lebih besar dari 0
            }
        });

        // Tombol plus
        $('.btn-num-product-up').on('click', function() {
            var input = $(this).siblings('input.num-product');
            var value = parseInt(input.val()); // Ambil nilai saat ini
            input.val(value + 1); // Tambah nilai 1
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        // Ketika tombol "Add to cart" diklik
        $('.js-addcart-detail').on('click', function() {
            var id = $(this).data('id'); // ID produk
            var nama = $(this).data('nama'); // Nama produk
            var harga = $(this).data('harga'); // Harga produk
            var quantity = parseInt($(this).closest('.size-204').find('input.num-product')
                .val()); // Ambil jumlah produk dan pastikan dalam format angka

            // Validasi jika quantity lebih dari 0
            if (isNaN(quantity) || quantity <= 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Jumlah tidak valid!',
                    text: 'Pastikan jumlah produk lebih dari 0.',
                    showConfirmButton: true
                });
                return; // Hentikan eksekusi jika jumlah tidak valid
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Kirim data ke server menggunakan AJAX
            $.ajax({
                url: "{{ route('cart.add') }}", // Ganti dengan route yang sesuai
                method: "POST",
                data: {
                    id: id,
                    nama: nama,
                    harga: harga,
                    quantity: quantity
                },
                success: function(response) {
                    // Ganti alert dengan SweetAlert2
                    Swal.fire({
                        icon: 'success',
                        title: 'Produk berhasil ditambahkan!',
                        text: 'Jumlah item di keranjang: ' + response.cart_count,
                        showConfirmButton: false,
                        timer: 1500,
                        toast: true,
                        position: 'top-end'
                    });

                    // Update tampilan jumlah produk di keranjang
                    $('#cart-count').text(response.cart_count);
                },

            });
        });
    });
</script>
@endsection