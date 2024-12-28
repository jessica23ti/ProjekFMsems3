@extends('layoutUser.temp', ['title' => 'CheckOut  '])
@section('content')
@section('hero-title')
    CheckOut
@endsection

@php
    $subTotal = 0; // Inisialisasi subtotal

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://api.rajaongkir.com/starter/province',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => ['key:a83772758c55b5e7ea48b40d11380c36'],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo 'cURL Error #:' . $err;
    } else {
        $provinsi = json_decode($response, true);
    }
@endphp



<div class="untree_co-section">
    <div class="container">
        <br><br>
        <div class="row">
            <div class="mb-5 mb-md-0 col-md-6">
                <h2 class="mb-3 text-black h3">Details </h2>
                <form action="" method="">
                    <div class="bg-white p-3 p-lg-5 border">
                        <div class="form-group row">

                            <div class="form-group">
                                <label for="c_country" class="text-black">Country <span
                                        class="text-danger">*</span></label>
                                <select id="provinsi" class="form-control" name="provinsi">
                                    <option value="">Pilih Provinsi</option>
                                    @php
                                        if ($provinsi['rajaongkir']['status']['code'] == 200) {
                                            // Pastikan 'results' adalah array sebelum melakukan looping
                                            foreach ($provinsi['rajaongkir']['results'] as $pv) {
                                                echo "<option value='$pv[province_id]'>$pv[province]</option>";
                                            }
                                        }
                                    @endphp

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kota" class="text-black">Kota <span class="text-danger">*</span></label>
                                <select id="kota" class="form-control" name="kota">


                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="c_address" class="text-black"> Shipping Address <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_address" name="c_address"
                                    placeholder="Street address">
                            </div>
                        </div>
                        <div class="mt-3 form-group">
                            <input type="text" class="form-control"
                                placeholder="Apartment, suite, unit etc. (optional)" name="optional">
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="c_state_country" class="text-black">State / Country <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_state_country" name="provinsi">
                            </div>
                            <div class="col-md-6">
                                <label for="c_postal_zip" class="text-black">Posta / Zip <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_postal_zip" name="kota">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="c_order_notes" class="text-black">Order Notes</label>
                            <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control"
                                placeholder="Write your notes here..."></textarea>
                        </div>

                    </div>
                </form>
            </div>

            <div class="col-md-6">
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
                                    @foreach ($cart as $kiw)
                                        <tr>
                                            <td>{{ $kiw->produk->nama }}<strong class="mx-2">x</strong>
                                                {{ $kiw->quantity }}</td>
                                            <td>{{ $kiw->produk->harga * $kiw->quantity }}</td>
                                            @php
                                                $subTotal += $kiw->produk->harga * $kiw->quantity;
                                            @endphp
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="font-weight-bold text-black"><strong>Cart Subtotal</strong></td>
                                        <td class="text-black">{{ $subTotal }}</td>
                                    </tr>

                                    <tr>
                                        <td class="font-weight-bold text-black"><strong>Order Total</strong></td>
                                        <td class="font-weight-bold text-black"><strong>$350.00</strong></td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="mb-5 row">
                                <div class="col-md-12">
                                    <h2 class="mb-3 text-black h3">Coupon Code</h2>
                                    <div class="bg-white p-3 p-lg-5 border">

                                        <label for="c_code" class="mb-3 text-black">Enter your coupon code if you have
                                            one</label>
                                        <div class="w-75 couponcode-wrap input-group">
                                            <input type="text" class="form-control me-2" id="c_code"
                                                placeholder="Coupon Code" aria-label="Coupon Code"
                                                aria-describedby="button-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-black btn-sm" type="button"
                                                    id="button-addon2">Apply</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button class="btn-block py-3 btn btn-black btn-lg"
                                    onclick="window.location='thankyou.html'">Place Order</button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- </form> -->
    </div>
</div>
@endsection

@section('script')
<script>
    document.getElementById('provinsi').addEventListener('change', function() {
        fetch('<?= url('/kota/') ?>/' + this.value, {
                method: 'GET'
            })
            .then(response => response.text()) // Mengubah respons menjadi teks
            .then(data => {
                // Mengolah data kota di sini
                console.log(data);
                document.getElementById('kota').innerHTML =
                    data // Menampilkan data di konsol atau mengolah lebih lanjut
            })
            .catch(error => console.error('Error:', error)); // Menangani error jika ada
    });
</script>
@endsection
