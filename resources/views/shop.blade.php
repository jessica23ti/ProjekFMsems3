@extends('layoutUser.tempDasar', ['title' => 'Shop UMKM'])
@section('content')
@section('hero-title')
    Shop UMKM Indonesia
@endsection

<!-- kateogori -->
<div class="sec-banner bg0 p-t-80 p-b-50">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                <!-- Block1 -->
                <div class="block1 wrap-pic-w">
                    <img src="{{ asset('asset/image/dress2.png') }}" alt="IMG-BANNER">

                    <a href="product.html"
                        class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                        <div class="block1-txt-child1 flex-col-l">
                            <span class="block1-name ltext-102 trans-04 p-b-8">
                                Pakaian dan Aksesori
                            </span>



                        </div>

                        <div class="block1-txt-child2 p-b-4 trans-05">
                            <div class="block1-link stext-101 cl0 trans-09">
                                Shop Now
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                <!-- Block1 -->
                <div class="block1 wrap-pic-w">
                    <img src="{{ asset('asset/image/kerajinan2.png') }}" alt="IMG-BANNER">

                    <a href="product.html"
                        class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                        <div class="block1-txt-child1 flex-col-l">
                            <span class="block1-name ltext-102 trans-04 p-b-8">
                                Karya Kerajinan Asli
                            </span>



                        </div>

                        <div class="block1-txt-child2 p-b-4 trans-05">
                            <div class="block1-link stext-101 cl0 trans-09">
                                Shop Now
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                <!-- Block1 -->
                <div class="block1 wrap-pic-w">
                    <img src="{{ asset('asset/image/tani.png') }}" alt="IMG-BANNER">

                    <a href="product.html"
                        class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                        <div class="block1-txt-child1 flex-col-l">
                            <span class="block1-name ltext-102 trans-04 p-b-8">
                                Pertanian
                            </span>


                        </div>

                        <div class="block1-txt-child2 p-b-4 trans-05">
                            <div class="block1-link stext-101 cl0 trans-09">
                                Shop Now
                            </div>
                        </div>
                    </a>
                </div>
            </div>


        </div>
    </div>


    <!-- Product -->
    <div class="bg0 m-t-23 p-b-140">

        <div class="untree_co-section product-section before-footer-section">
            <div class="p-b-10">
                <h3 class="ltext-103 cl5">
                    Product Overview
                </h3>
            </div>


            </header>




            <!-- Product -->
            <div class="bg0 m-t-23 p-b-140">
                <div class="container">
                    <div class="flex-w flex-sb-m p-b-52">
                        <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                            <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
                                All Products
                            </button>
                            <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".women">
                                Kerajinan
                            </button>

                            <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".men">
                                Perhiasan
                            </button>

                            <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".bag">
                                Pertanian
                            </button>
                        </div>
                    </div>



                    <div class="row isotope-grid">
                        @foreach ($produk as $produk1)
                            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                                <!-- Block2 -->
                                <div class="block2">
                                    <div class="block2-pic hov-img0">
                                        @php
                                            // Mengambil gambar pertama jika ada
                                            $image = $produk1->images->first();
                                        @endphp

                                        @if ($image)
                                            <!-- Pastikan gambar ada dan tampilkan gambar -->
                                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="IMG-PRODUCT"
                                                width="60px" height="300px">
                                        @endif

                                        <a href=""
                                            class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                            Quick View
                                        </a>
                                    </div>

                                    <div class="block2-txt flex-w flex-t p-t-14">
                                        <div class="block2-txt-child1 flex-col-l ">
                                            <a href="/detail/{{ $produk1->id }}"
                                                class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                Nama : {{ $produk1->nama }}
                                            </a>

                                            <span class="stext-105 cl3">
                                                Harga : {{ $produk1->harga }}

                                            </span>
                                        </div>

                                        <div class="block2-txt-child2 flex-r p-t-3">
                                            <a href="#"
                                                class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                                <img class="icon-heart1 dis-block trans-04"
                                                    src="{{ asset('image/icons/icon-heart-01.png') }}" alt="ICON">
                                                <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                                    src="{{ asset('image/icons/icon-heart-02.png') }}" alt="ICON">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <!-- Load more -->
                    <div class="flex-c-m flex-w w-full p-t-45">
                        <button
                            class="load-more-btn flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                            Load More
                        </button>
                    </div>

                </div>
            </div>
            <!-- Back to top -->
            <div class="btn-back-to-top" id="myBtn">
                <span class="symbol-btn-back-to-top">
                    <i class="zmdi zmdi-chevron-up"></i>
                </span>
            </div>
            <!-- Modal1 -->
            <div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
                <div class="overlay-modal1 js-hide-modal1"></div>

                <div class="container">
                    <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
                        <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                            <img src="images/icons/icon-close.png" alt="CLOSE">
                        </button>

                        <div class="row">
                            <div class="col-md-6 col-lg-7 p-b-30">
                                <div class="p-l-25 p-r-30 p-lr-0-lg">
                                    <div class="wrap-slick3 flex-sb flex-w">
                                        <div class="wrap-slick3-dots"></div>
                                        <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                                        <div class="slick3 gallery-lb">
                                            <div class="item-slick3" data-thumb="images/product-detail-01.jpg">
                                                <div class="wrap-pic-w pos-relative">
                                                    <img src="images/product-detail-01.jpg" alt="IMG-PRODUCT">

                                                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                        href="images/product-detail-01.jpg">
                                                        <i class="fa fa-expand"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="item-slick3" data-thumb="images/product-detail-02.jpg">
                                                <div class="wrap-pic-w pos-relative">
                                                    <img src="images/product-detail-02.jpg" alt="IMG-PRODUCT">

                                                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                        href="images/product-detail-02.jpg">
                                                        <i class="fa fa-expand"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="item-slick3" data-thumb="images/product-detail-03.jpg">
                                                <div class="wrap-pic-w pos-relative">
                                                    <img src="images/product-detail-03.jpg" alt="IMG-PRODUCT">

                                                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                        href="images/product-detail-03.jpg">
                                                        <i class="fa fa-expand"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-5 p-b-30">
                                <div class="p-r-50 p-t-5 p-lr-0-lg">
                                    <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                                        Lightweight Jacket
                                    </h4>

                                    <span class="mtext-106 cl2">
                                        $58.79
                                    </span>

                                    <p class="stext-102 cl3 p-t-23">
                                        Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula.
                                        Mauris consequat ornare feugiat.
                                    </p>

                                    <!--  -->
                                    <div class="p-t-33">
                                        <div class="flex-w flex-r-m p-b-10">
                                            <div class="size-203 flex-c-m respon6">
                                                Size
                                            </div>

                                            <div class="size-204 respon6-next">
                                                <div class="rs1-select2 bor8 bg0">
                                                    <select class="js-select2" name="time">
                                                        <option>Choose an option</option>
                                                        <option>Size S</option>
                                                        <option>Size M</option>
                                                        <option>Size L</option>
                                                        <option>Size XL</option>
                                                    </select>
                                                    <div class="dropDownSelect2"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex-w flex-r-m p-b-10">
                                            <div class="size-203 flex-c-m respon6">
                                                Color
                                            </div>

                                            <div class="size-204 respon6-next">
                                                <div class="rs1-select2 bor8 bg0">
                                                    <select class="js-select2" name="time">
                                                        <option>Choose an option</option>
                                                        <option>Red</option>
                                                        <option>Blue</option>
                                                        <option>White</option>
                                                        <option>Grey</option>
                                                    </select>
                                                    <div class="dropDownSelect2"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex-w flex-r-m p-b-10">
                                            <div class="size-204 flex-w flex-m respon6-next">
                                                <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                                    </div>

                                                    <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                        name="num-product" value="1">

                                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                                    </div>
                                                </div>

                                                <button
                                                    class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                                    Add to cart
                                                </button>
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

                                        <a href="#"
                                            class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                            data-tooltip="Facebook">
                                            <i class="fa fa-facebook"></i>
                                        </a>

                                        <a href="#"
                                            class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                            data-tooltip="Twitter">
                                            <i class="fa fa-twitter"></i>
                                        </a>

                                        <a href="#"
                                            class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                            data-tooltip="Google Plus">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>



@endsection

@section('script')
    <script>
        $(document).ready(function() {
            let skip = 4; // Menentukan jumlah produk yang sudah dimuat

            $('.load-more-btn').on('click', function() {
                $.ajax({
                    url: '{{ route('load.more') }}',
                    method: 'GET',
                    data: {
                        skip: skip
                    },
                    success: function(response) {
                        // Menambahkan produk baru ke halaman
                        $('.isotope-grid').append(response);
                        skip += 4; // Menambah jumlah produk yang dimuat
                    }
                });
            });
        });
    </script>
@endsection
