@extends('layoutUser.temp')
@section('content')

@section('hero-title')
    Menumbuhkan Ekonomi Lokal Lewat Inovasi UMKM
@endsection
<!-- Start Product Section -->
<x-product-section />
<!-- End Product Section -->

<!-- Start Why Choose Us Section -->
<x-promotion />
<!-- End Why Choose Us Section -->

<!-- Start We Help Section -->
<x-we-help-section />
<!-- End We Help Section -->

<!-- Start Popular Product -->
<div class="popular-product">
    <div class="container">
        <div class="row">

            <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
                <div class="product-item-sm d-flex">
                    <div class="thumbnail">
                        <img src="images/product-1.png" alt="Image" class="img-fluid">
                    </div>
                    <div class="pt-3">
                        <h3>Nordic Chair</h3>
                        <p>Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio </p>
                        <p><a href="#">Read More</a></p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
                <div class="product-item-sm d-flex">
                    <div class="thumbnail">
                        <img src="images/product-2.png" alt="Image" class="img-fluid">
                    </div>
                    <div class="pt-3">
                        <h3>Kruzo Aero Chair</h3>
                        <p>Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio </p>
                        <p><a href="#">Read More</a></p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
                <div class="product-item-sm d-flex">
                    <div class="thumbnail">
                        <img src="images/product-3.png" alt="Image" class="img-fluid">
                    </div>
                    <div class="pt-3">
                        <h3>Ergonomic Chair</h3>
                        <p>Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio </p>
                        <p><a href="#">Read More</a></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Popular Product -->

<!-- Start Testimonial Slider -->
<div class="testimonial-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto text-center">
                <h2 class="section-title">Testimonials</h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="testimonial-slider-wrap text-center">

                    <div id="testimonial-nav">
                        <span class="prev" data-controls="prev"><span class="fa fa-chevron-left"></span></span>
                        <span class="next" data-controls="next"><span class="fa fa-chevron-right"></span></span>
                    </div>

                    <div class="testimonial-slider">

                        <div class="item">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 mx-auto">

                                    <div class="testimonial-block text-center">
                                        <blockquote class="mb-5">
                                            <p>Sebagai pemilik usaha kecil, saya merasa sangat terbantu dengan website
                                                ini. Desainnya yang simple dan mudah dipahami membuat saya bisa
                                                mengelola produk dan menerima pesanan dengan lebih efisien. Selain itu,
                                                fitur pembayaran yang terintegrasi membuat proses transaksi menjadi
                                                lebih cepat dan aman. Website ini sangat membantu meningkatkan
                                                visibilitas bisnis saya, dan saya merasa lebih dekat dengan pelanggan.
                                                Sangat direkomendasikan untuk UMKM yang ingin berkembang</p>
                                        </blockquote>

                                        <div class="author-info">
                                            <div class="author-pic">
                                                <img src="https://img.freepik.com/free-photo/front-view-smiley-man-seaside_23-2149737022.jpg"
                                                    alt="Maria Jones" class="img-fluid">
                                            </div>
                                            <h3 class="font-weight-bold">Jessica Nathania</h3>
                                            <span class="position d-block mb-3">CEO, Co-Founder, TechSIA.</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- END item -->

                        <div class="item">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 mx-auto">

                                    <div class="testimonial-block text-center">
                                        <blockquote class="mb-5">
                                            <p>Website ini luar biasa! Sebagai pemilik toko online kecil, saya bisa
                                                dengan mudah mengelola stok barang, mengupdate harga, dan menerima
                                                pesanan kapan saja. Fitur pemesanan yang otomatis sangat menghemat waktu
                                                saya. Selain itu, tampilan website yang profesional juga membantu
                                                memberikan kesan yang lebih baik kepada pelanggan. Kini, bisnis saya
                                                semakin dikenal banyak orang</p>
                                        </blockquote>

                                        <div class="author-info">
                                            <div class="author-pic">
                                                <img src="https://media.istockphoto.com/id/1397918527/photo/adult-asian-man-standing-and-cheering-while-showing-paper-money-that-he-hold.jpg?s=612x612&w=0&k=20&c=5sckR3PV6KI8qQPRBNpN9hJUgALggMU3IGOOANtXWAk="
                                                    alt="Maria Jones" class="img-fluid">
                                            </div>
                                            <h3 class="font-weight-bold">Robby Juanda</h3>
                                            <span class="position d-block mb-3">CEO, Co-Founder, XYZ Inc.</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- END item -->

                        <div class="item">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 mx-auto">

                                    <div class="testimonial-block text-center">
                                        <blockquote class="mb-5">
                                            <p>Saya sangat puas dengan website UMKM ini! Proses pendaftaran dan setup
                                                yang mudah membuat saya bisa langsung memulai jualan online tanpa
                                                kesulitan. Dengan integrasi sistem pembayaran yang aman, pelanggan saya
                                                merasa nyaman berbelanja. Keberadaan website ini memberikan peluang
                                                besar untuk memperluas pasar, bahkan di luar kota. Saya sangat
                                                merekomendasikan untuk semua pelaku UMKM yang ingin go digital</p>
                                        </blockquote>

                                        <div class="author-info">
                                            <div class="author-pic">
                                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT6dlpGkeeSg3O7UviUZp27YVpvQN_idziw0w&s"
                                                    alt="Maria Jones" class="img-fluid">
                                            </div>
                                            <h3 class="font-weight-bold">Mianti Haresh</h3>
                                            <span class="position d-block mb-3">CEO, Co-Founder, XYZ Inc.</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- END item -->

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Testimonial Slider -->
@endsection
