<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">
    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />
    <!-- Bootstrap CSS -->
    <!-- ICon : -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('asset/css/main copy.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/util copy.css') }}">
    <link href="{{ asset('asset/css/furniCSS.css') }}" rel="stylesheet">
    <title>{{ $title ?? 'UMKM INDONESIA' }}</title>
</head>

<body>

    <!-- Start Header/Navigation -->
    <nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

        <div class="container">
            <a class="navbar-brand" href="#">Nusantara Craft<span>.</span></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
                aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsFurni">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('Produk.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('Produk.index') }}">Shop</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('AboutUsCustomer') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('AboutUsCustomer') }}">About us</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('ContactCustomer') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('ContactCustomer') }}">Contact us</a>
                    </li>
                </ul>

                <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                    {{-- <li><a class="nav-link" href="{{ route('showtAdmin') }}"><img
                                src="{{ asset('furni-1.0.0/images/user.svg') }}"></a>
                    </li> --}}
                    <li><a class="nav-link" href="{{ route('cartCustomer') }}"> <svg xmlns="http://www.w3.org/2000/svg"
                                width="25" height="25" fill="currentColor" class="bi bi-cart-fill"
                                viewBox="0 0 16 16">
                                <path
                                    d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                            </svg></a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('login.store') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </nav>
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1> @yield('hero-title', 'default Title')<span clsas="d-block"></span></h1>
                        <p class="mb-4">Dukung pengrajin Indonesia, temukan karya terbaik dari <br>UMKM Indonesia
                            Pelosok.
                        </p>
                        <p><a href="{{ route('Produk.index') }}" class="btn btn-secondary me-2">Shop Now</a><a
                                href="{{ route('Produk.index') }}" class="btn btn-white-outline">Explore</a></p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="hero-img-wrap">
                        {{-- <img src="{{ asset('furni-1.0.0/images/couch.png') }} " class="img-fluid"> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->
    @yield('content')

    <!-- Start Footer Section -->
    <footer class="footer-section">
        <div class="container relative">

            <div class="sofa-img">
                <img src="{{ asset('furni-1.0.0/images/sofa.png') }}" alt="Image" class="img-fluid">
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="subscription-form">
                        <h3 class="d-flex align-items-center"><span class="me-1"><img
                                    src="images/envelope-outline.svg" alt="Image"
                                    class="img-fluid"></span><span>Subscribe to Newsletter</span></h3>

                        <form action="#" class="row g-3">
                            <div class="col-auto">
                                <input type="text" class="form-control" placeholder="Enter your name">
                            </div>
                            <div class="col-auto">
                                <input type="email" class="form-control" placeholder="Enter your email">
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-primary">
                                    <span class="fa fa-paper-plane"></span>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="row g-5 mb-5">
                <div class="col-lg-4">
                    <div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">Nusantara
                            Craft<span>.</span></a>
                    </div>
                    <p class="mb-4"> Kami mendukung perkembangan UMKM di Indonesia dengan menyediakan produk
                        berkualitas dan layanan terbaik untuk masyarakat. Jadilah bagian dari perjalanan kami menuju
                        kemajuan ekonomi lokal.
                    </p>

                    <ul class="list-unstyled custom-social">
                        <li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
                        <li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
                        <li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
                        <li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
                    </ul>
                </div>

                <div class="col-lg-8">
                    <div class="row links-wrap">
                        <div class="col-6 col-sm-6 col-md-3">
                            <ul class="list-unstyled">
                                <li><a href="{{ route('Produk.index') }}">Shop</a></li>
                                <li><a href="#">About us</a></li>
                                <li><a href="#">Contact us</a></li>

                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>

        </div>
    </footer>
    <!-- End Footer Section -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.min.js"></script>
    <script src="{{ asset('asset/js/custom.js') }}"></script> <!-- Tetap menggunakan file lokal -->
    <script src="{{ asset('asset/js/mainFurni.js') }}"></script> <!-- Tetap menggunakan file lokal -->
    <script src="{{ asset('asset/js/map-custom.js') }}"></script> <!-- Tetap menggunakan file lokal -->
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    @yield('script')

</body>

</html>
