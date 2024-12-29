@extends('layoutUser.temp', ['title' => 'Bayar  '])
@section('content')
@section('hero-title')
    Bayar
@endsection
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
                        @if (isset($cart))
                            @foreach ($cart as $kiw)
                                {{-- <label for="c_address" class="text-black"> Berat <span
                                    class="text-danger">*</span></label> --}}

                                <tr>
                                    <td>{{ $kiw->produk->nama }}<strong class="mx-2">x</strong>
                                        {{ $kiw->quantity }}
                                    </td>
                                    <td>{{ $kiw->produk->harga * $kiw->quantity }}</td>
                                    $subTotal += $kiw->produk->harga * $kiw->quantity;
                                </tr>
                            @endforeach
                        @endif
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

                            <label for="c_code" class="mb-3 text-black">Enter your coupon code if you
                                have
                                one</label>
                            <div class="w-75 couponcode-wrap input-group">
                                <input type="text" class="form-control me-2" id="c_code" placeholder="Coupon Code"
                                    aria-label="Coupon Code" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-black btn-sm" type="button"
                                        id="button-addon2">Apply</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn-block py-3 btn btn-black btn-lg" onclick="window.location='thankyou.html'"
                        type="submit">Place Order</button>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
