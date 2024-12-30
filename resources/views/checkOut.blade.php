@extends('layoutUser.temp', ['title' => 'CheckOut  '])
@section('content')
@section('hero-title')
    CheckOut
@endsection

@php
    $beratTotal = 0;
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
            <div class="mb-5 mb-md-0 col-md-7">
                <h2 class="mb-3 text-black h3">Details </h2>
                <form action="{{ route('hitungOngkir') }}" method="POST">
                    @csrf
                    <div class="bg-white p-3 p-lg-5 border">
                        <div class="form-group row">
                            <!-- Provinsi dan Kota dalam 1 baris -->
                            <div class="col-md-6">
                                <label for="provinsi" class="text-black">Provinsi <span
                                        class="text-danger">*</span></label>
                                <select id="provinsi" class="form-control" name="provinsi">
                                    <option value="">Pilih Provinsi</option>
                                    @php
                                        if ($provinsi['rajaongkir']['status']['code'] == 200) {
                                            foreach ($provinsi['rajaongkir']['results'] as $pv) {
                                                echo "<option value='$pv[province_id]'>$pv[province]</option>";
                                            }
                                        }
                                    @endphp
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="kota" class="text-black">Kota <span class="text-danger">*</span></label>
                                <select id="kota" class="form-control" name="kota">
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <!-- Berat dan Ekspedisi dalam 1 baris -->
                            <div class="col-md-6">
                                <label for="c_postal_zip" class="text-black">Berat <span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="berat" name="berat">
                            </div>

                            <div class="col-md-6">
                                <label for="ekspidisi" class="text-black">Pilih Ekspedisi <span
                                        class="text-danger">*</span></label>
                                <select id="ekspidisi" class="form-control" name="ekspidisi">
                                    <option value="">Pilih Ekspedisi</option>
                                    @php
                                        $eks = ['jne' => 'JNE', 'pos' => 'POS', 'tiki' => 'TIKI'];
                                        foreach ($eks as $key => $value) {
                                            echo "<option value='$key'>$value</option>";
                                        }
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="c_address" class="text-black">Shipping Address <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="c_address" name="c_address"
                                placeholder="Street address">
                        </div>
                        <div class="mt-3 form-group">
                            <input type="text" class="form-control"
                                placeholder="Apartment, suite, unit etc. (optional)" name="optional">
                        </div>



                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="c_postal_zip" class="text-black">Postal Code / Zip <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_postal_zip" name="postal">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="c_order_notes" class="text-black">Order Notes</label>
                            <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control"
                                placeholder="Write your notes here..."></textarea>
                        </div><br>

                        <div class="form-group">
                            <button class="btn btn-black btn-sm" type="submit">Proses</button>
                        </div>
                    </div>
                </form>

            </div>

            <!-- Bagian Ongkir -->
            <div class="col-md-5">
                <h2 class="mb-3 text-black h3">Data Ongkir</h2>
                <div class="row">
                    @php
                        if (isset($ongkir)) {
                            $biaya = json_decode($ongkir, true);
                            if ($biaya['rajaongkir']['status']['code'] == 200) {
                                foreach ($biaya['rajaongkir']['results'][0]['costs'] as $by) {
                                    echo "
                                <div class='col-sm-12 mb-3'>
                                    <div class='card'>
                                        <div class='card-body'>
                                            <h5 class='card-title'>" .
                                        $by['service'] .
                                        "</h5>
                                            <p class='card-text'>" .
                                        $by['description'] .
                                        "</p>
                                            <p class='card-text'>Rp" .
                                        number_format($by['cost'][0]['value'], 0, ',', '.') .
                                        "</p>
                                            <p class='card-title'>Estimasi Pengiriman : " .
                                        $by['cost'][0]['etd'] .
                                        "</p> 
                                                 <a href='#' id='bayar-button'
                                                   class='btn btn-black btn-sm ongkir-option'
                                                   data-ongkir-value='" .
                                        $by['cost'][0]['value'] .
                                        "' >
                                                   Bayar
                                                </a><a href='/cartView' class='btn btn-black btn-sm '>Cancel</a>
                                        </div>
                                    </div>
                                </div>";
                                }
                            }
                        }
                    @endphp
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
<script>
    $(document).ready(function() {
        // Event listener untuk tombol ongkir
        $('.ongkir-option').on('click', function(e) {
            e.preventDefault(); // Mencegah default action tombol

            // Ambil nilai ongkir dari atribut data-ongkir-value
            var ongkirValue = $(this).data('ongkir-value');


            // Kirim data ongkir dan selectedId ke server menggunakan AJAX
            $.ajax({
                url: "{{ route('PaymentUpdate') }}", // Route ke controller Anda
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}", // Token CSRF untuk keamanan
                    ongkir: ongkirValue, // Kirim nilai ongkir yang diambil

                },
                success: function(response) {
                    // Tampilkan respons dari server jika berhasil
                    console.log(response); // Debugging
                    alert("Ongkir berhasil diproses: Rp" + ongkirValue);
                    var snapToken = response.paket.snapToken;
                    var data = response.paket.data;

                    console.log('SnapToken:', snapToken);
                    console.log('Data:', data);

                    // Setelah sukses, jalankan pembayaran
                    if (snapToken) {
                        snap.pay(snapToken, {
                            onSuccess: function(result) {
                                // Proses berhasil
                                window.location.href = '{{ route('sukses') }}';
                            },
                            onPending: function(result) {
                                // Proses tertunda
                                document.getElementById('result-json')
                                    .innerHTML += JSON.stringify(result, null,
                                        2);
                            },
                            onError: function(result) {
                                // Proses gagal
                                document.getElementById('result-json')
                                    .innerHTML += JSON.stringify(result, null,
                                        2);
                            }
                        });
                    } else {
                        alert('SnapToken belum tersedia.');
                    }
                },
                error: function(xhr, status, error) {
                    // Menampilkan pesan error jika terjadi masalah dengan request
                    console.log("Error details:", error);
                    console.log("Status:", status);
                    console.log("Response:", xhr.responseText);
                    console.error("Terjadi kesalahan: " + error);
                }
            });

            // Tambahkan efek visual pada tombol yang dipilih
            $('.ongkir-option').removeClass('selected'); // Menghapus kelas selected pada tombol lain
            $(this).addClass('selected'); // Menambahkan kelas selected pada tombol yang diklik
        });
    });
</script>




<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
@endsection
