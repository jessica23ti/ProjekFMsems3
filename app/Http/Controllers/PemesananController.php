<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Produk;
use App\Models\Pemesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pemesanan'] = Pemesanan::latest()->paginate(10);
        return view('Admin.pemesanan_index', $data);
    }

    public function AboutUs()
    {
        return view('aboutUs');
    }
    public function ViewCheckout()
    {
        return view('checkOut');
    }
    public function bayar(Request $request) {}

    public function kota($provinsi_id)
    {
        $curl = curl_init();

        // API untuk mengambil kota berdasarkan provinsi
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.rajaongkir.com/starter/city?&province=' . $provinsi_id,
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
            $kota = json_decode($response, true);
            if ($kota['rajaongkir']['status']['code'] == ' 200') {
                echo "<option value='' >Pilih Kota</option>";

                foreach ($kota['rajaongkir']['results'] as $kt) {
                    echo "<option value='$kt[city_id]' >$kt[city_name]</option>";
                }
            }
        }
    }

    public function hitungOngkir(Request $request)
    {
        // Memastikan input 'kota' dan 'berat' tersedia
        if ($request->isMethod('post')) {
            $postFields = "origin=457" .
                "&destination=" . $request->input('kota') .
                "&weight=" . $request->input('berat') .
                "&courier=" . $request->input('ekspidisi');

            // Inisialisasi CURL
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $postFields,
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded",
                    "key: a83772758c55b5e7ea48b40d11380c36"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                // Menampilkan error jika ada
                echo "cURL Error #:" . $err;
            } else {
                $data['ongkir'] = $response;
                return view('checkOut', $data);
            }
        }
    }


    public function Co(Request $request)
    {
        // Mengambil data selected_items dari request
        $selectedItems = request()->input('selected_items');
        $selectedItemsArray = json_decode($selectedItems, true);
        // Memastikan data adalah array
        if (is_array($selectedItemsArray)) {
            // Ambil data cart berdasarkan id yang terpilih
            $cart = Cart::whereIn('id', $selectedItemsArray)->get();
            // Kirim data ke view
            return view('bayar', compact('cart'));
        } else {
            // Jika data tidak valid, memberikan pesan error atau mengarahkan kembali
            return redirect()->back()->with('error', 'Item yang dipilih tidak valid.');
        }
    }

    public function updateCart(Request $request, $id_keranjang)
    {
        // Validasi data
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);
        // Cari item keranjang berdasarkan id
        $cartItem = Cart::findOrFail($id_keranjang);

        // Update jumlah item
        $cartItem->quantity = $request->input('jumlah');
        $cartItem->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('cartCustomer')->with('success', 'Item berhasil diperbarui.');
    }

    public function add_chart(Request $request)
    {
        // Cek apakah produk sudah ada di keranjang

        $product_Chart = [
            'id' => $request->id, // Validasi bahwa id produk ada di tabel produk
            'quantity' => $request->quantity, // Validasi jumlah produk (min 1)
        ];
        $cartItem = Cart::where('product_id', $product_Chart['id'])
            ->first();
        $userId = Auth::id();
        // dd($request->id);
        if ($cartItem) {
            // Jika produk sudah ada, update jumlahnya
            $cartItem->quantity = $request->quantity; // Menambah quantity produk
            $cartItem->$userId;
            $cartItem->product_id = $request->id;
            $cartItem->save();
            session()->flash('success', 'Data berhasil Diupdate di keranjang.');
        } else {
            // Jika produk belum ada di keranjang, simpan item baru
            Cart::create([
                'user_id' => $userId,
                'product_id' => $product_Chart['id'],
                'quantity' => $product_Chart['quantity'],
            ]);
            session()->flash('success', 'Data berhasil dimasukkan ke Keranjang.');
        }
        return redirect()->route('detailProduct', $request->id);
        // //     // Ambil user yang sedang login
        // $user = auth()->user();





        //     // Hitung jumlah item di keranjang
        //     $cartCount = Cart::where('user_id', $user->id)->sum('quantity');


    }

    public function detail($id)
    {
        $produk = Produk::where('id', $id)->first();
        return view('product_detail', compact('produk'));
    }
    public function CartUpdate(Request $request)
    {
        $quantities = $request->input('quantity');

        foreach ($quantities as $cartId => $quantity) {
            $cart = Cart::find($cartId);
            if ($cart) {
                $cart->quantity = $quantity;
                $cart->save();
            }
        }
        return redirect()->route('cartCustomer')->with('success', 'Keranjang berhasil diperbarui.');
    }
    public function  Contact()
    {
        $id = Auth::id();
        $user = User::where('id', $id)->get();
        return view('contact', $user);
    }
    public function  cart()
    {
        $cart = Cart::with('produk.images') // Eager loading untuk relasi produk dan gambar
            ->get(); // Mengambil semua data  keranjang

        return view('cart', compact('cart'));
    }
    public function  deleteCart(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return redirect()->route('cartCustomer');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        //
    }
}
