<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Authentication</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animsition@4.0.2/dist/css/animsition.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="{{ asset('asset/css/util.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/main.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <div class="bg-overlay"></div>
    <div class="form-structor">
        @if (Auth::check() && !Auth::user()->hasVerifiedEmail())
            <!-- Verifikasi Email -->
            <div class="verify-email">
                <h1 class="form-title">Email Verification</h1>
                <div class="alert alert-warning">
                    Please verify your email to complete registration.
                </div>
                <form action="{{ route('verification.resend') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Resend Verification Email</button>
                </form>
            </div>
        @elseif (!Auth::check())
            <!-- Form Registrasi -->
            <div class="signup">
                <h1 class="form-title">Sign up</h1>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="form-holder">
                    <form action="{{ route('register.store') }}" method="POST">
                        @csrf
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Username</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                    required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                    required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" required>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="no_hp" class="form-label">No Handphone</label>
                                <input type="text" class="form-control" name="no_hp" required>
                                @error('no_hp')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="submit-btn">Sign Up</button>
                    </form>
                </div>
            </div>
        @elseif(Auth::check() && Auth::user()->hasVerifiedEmail())
            <!-- Form Login -->
            <div class="login">
                <h2 class="form-title"><span>or</span>Log in</h2>

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('login.store') }}" method="POST">
                    @csrf
                    <div class="wrap-input100">
                        <span class="label-input100"><i class="bi bi-people-fill"></i> Email</span>
                        <input class="input100" type="email" name="email" placeholder="Type your Email">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="wrap-input100">
                        <span class="label-input100"><i class="bi bi-eye-fill"></i> Password</span>
                        <input class="input100" type="password" name="password" placeholder="Type your password">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-right">
                        <a href="#">Forgot password?</a>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">Login</button>
                    </div>
                </form>
            </div>
        @endif
    </div>

    <!-- Scripts -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
