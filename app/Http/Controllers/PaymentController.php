<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SelectedItem;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    // public function test(Request $request)
    // {
    //     $selectedItems = $request->input('selected_items');

    //     // Cek apakah selected_items ada dan berupa string JSON
    //     if (is_string($selectedItems)) {
    //         $selectedItemsArray = json_decode($selectedItems, true); // Ubah JSON string menjadi array
    //         dd($selectedItems);
    //         // Jika json_decode gagal (misalnya format JSON tidak valid)
    //         if (json_last_error() !== JSON_ERROR_NONE) {
    //             return response()->json(['error' => 'Invalid JSON format'], 400);
    //         }

    //         // Lakukan sesuatu dengan array $selectedItemsArray
    //     }
    public function processOrder(Request $request)
    {
        // Mendapatkan data produk yang dipilih dari request
        $cartData = $request->input('cart'); // Pastikan nama parameter sesuai dengan yang dikirimkan

        if ($cartData) {
            // Proses data produk yang dipilih dan simpan ke database
            foreach ($cartData as $item) {
                // Hitung total harga produk (harga per item * quantity)
                // Simpan data produk yang dipilih ke dalam tabel selected_items
                SelectedItem::create([
                    'selectedItems' => $item['id'],  // Nama produk (bisa disesuaikan)
                    'quantity' => $item['quantity'],  // Jumlah produk
                    'TotalHarga' => $item['total'],  // Total harga (harga * quantity)
                    'harga' => $item['harga'],  // Total harga (harga * quantity)
                ]);
            }

            // Mengembalikan response sukses dengan redirect_url
            return response()->json([
                'message' => 'Your order has been successfully placed!',
                'redirect_url' => route('ViewCheckout') // Ganti dengan route yang sesuai
            ]);
            // } else {
            //     // Jika tidak ada produk yang dipilih, mengirimkan response error
            //     return response()->json([
            //         'message' => 'No items selected.',
            //     ], 400); // Mengirim response error dengan status 400 jika tidak ada produk yang dipilih
            // }
        }
    }



    public function createCharge(Request $request)
    {
        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => $request->amount,
            ],
            'customer_details' => [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);
        return response()->json($snapToken);
    }
}
