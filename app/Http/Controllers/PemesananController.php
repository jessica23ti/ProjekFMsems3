<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (request()->wantsJson()) {
            return response()->json('hallo F');
        }
        return view('index');
    }
    public function shop()
    {
        $produk = Produk::with('images')->get(); // Mengambil semua produk dan gambar terkait
        // Ganti $id dengan ID yang sesuai
        // dd($produk1);
        return view('shop', compact('produk'));
    }
    public function AboutUs()
    {
        return view('aboutUs');
    }
    // public function add_chart(Request $request)
    // {

    //     // Validasi data yang diterima
    //     $validated = $request->validate([
    //         'id' => 'required|', // Validasi bahwa id produk ada di tabel produk
    //         'quantity' => 'required|integer', // Validasi jumlah produk (min 1)
    //     ]);

    //     $product_Chart = [
    //         'id' => $validated['id'], // Validasi bahwa id produk ada di tabel produk
    //         'quantity' => $validated['quantity'], // Validasi jumlah produk (min 1)
    //     ];
    //     //     // Ambil user yang sedang login
    //     $user = auth()->user();

    //     // Cek apakah produk sudah ada di keranjang
    //     $cartItem = Cart::where('user_id', $user->id)
    //         ->where('product_id', $product_Chart['id'])
    //         ->first();

    //     if ($cartItem) {
    //         // Jika produk sudah ada, update jumlahnya
    //         $cartItem->quantity += $product_Chart['quantity']; // Menambah quantity produk
    //         $cartItem->save();
    //     } else {
    //         // Jika produk belum ada di keranjang, simpan item baru
    //         Cart::create([
    //             'user_id' => $user->id,
    //             'product_id' => $product_Chart['id'],
    //             'quantity' => $product_Chart['quantity'],
    //         ]);
    //     }

    //     //     // Hitung jumlah item di keranjang
    //     //     $cartCount = Cart::where('user_id', $user->id)->sum('quantity');

    //     //     // Kembalikan response berupa jumlah item di keranjang
    //     //     // return response()->json(['cart_count' => $cartCount]);
    //     // } catch (\Exception $e) {
    //     //     // Tangkap exception jika terjadi error dan kembalikan pesan error
    //     //     return response()->json(['error' => $e->getMessage()], 500);
    //     // }
    // }

    public function detail($id)
    {
        $produk = Produk::where('id', $id)->first();
        return view('product_detail', compact('produk'));
    }
    public function  Contact()
    {
        return view('contact');
    }
    public function  cart()
    {
        return view('cart');
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
    public function store(Request $request)
    {
        //
    }

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
    public function edit(String $pemesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $pemesanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        //
    }
}
