<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\SelectedItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;

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
    public function getThanku()
    {
        return view('thankYou');
    }
    public function processOrderUpdate(Request $request)
    {
        // Ambil ongkir dari request
        $ongkir = $request->input('ongkir');

        // Cari semua selectedID yang terkait dengan user yang sedang login
        $userId = Auth::id();
        $selectedItems = SelectedItem::where('user_id', $userId)->get();

        // Update ongkir untuk setiap order yang ditemukan
        foreach ($selectedItems as $item) {
            // Asumsi bahwa 'ongkir' adalah atribut di SelectedItem
            $item->ongkir = $ongkir;
            $item->save();
        }

        // Hitung total TotalHarga, Ongkir, dan Quantity untuk user tersebut
        $totalHarga = $selectedItems->sum('TotalHarga');
        $ongkir = $selectedItems->sum('Ongkir');
        $total_item_pesanan = $selectedItems->sum('quantity');

        // Hitung total keseluruhan
        $total = $totalHarga + $ongkir;

        // Buat pesanan baru dan simpan di tabel orders
        $order = Pemesanan::updateOrCreate(
            ['user_id' => $userId, 'status_pesan' => 'pending'], // Kondisi untuk mencari data yang sudah ada
            [
                'total_biaya' => $total,
                'shipping_address' => 'ALAAMAT',
                'total_item_pesanan' => $total_item_pesanan,
            ]
        );

        // Hubungkan produk yang dipilih ke pesanan melalui tabel pivot order_product
        foreach ($selectedItems as $item) {
            $order->produk()->attach($item->product_id);  // Asumsi 'product_id' adalah kolom yang menyimpan id produk
        }

        // Siapkan data transaksi untuk dikirim ke view
        $data = [
            'user_id' => $userId,
            'total_item_pesanan' => $total_item_pesanan,
            'total_biaya' => $total,
            'status_pesan' => 'pending',
        ];

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;  // Gunakan false untuk sandbox
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => $total, // Total amount for the transaction
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->no_hp,
            ],
        ];

        // Dapatkan Snap Token dari Midtrans
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $order->snap_item = $snapToken;
        $order->save();

        // Kirim data snapToken dan transaksi ke view
        return response()->json([
            'status' => 'success',
            'message' => 'Ongkir berhasil diproses',
            'paket' => ['data' => $data, 'snapToken' => $snapToken] // Mengirimkan data dan snapToken dalam URL
        ]);
    }
    public function getViewPayment(Request $request)
    {

        $data = $request->input('data'); // Mendapatkan data dari query string
        $snapToken = $request->input('snapToken'); // Mendapatkan snapToken dari query string

        // Anda bisa mengirimkan data ini ke view
        return view('payment', [
            'snapToken' => $snapToken,
            'transaksi' => $data,
        ]);
    }

    public function processOrder(Request $request)
    {
        // Mendapatkan data produk yang dipilih dari request
        $cartData = $request->input('cart'); // Data keranjang yang dikirim melalui request

        // Inisialisasi array untuk menyimpan ID
        $orderIds = [];
        $userId = Auth::id();
        if ($cartData) {
            // Proses setiap item dalam keranjang
            foreach ($cartData as $item) {
                // Debugging untuk melihat item yang diproses


                // Simpan atau perbarui data dengan updateOrCreate
                $selectedItem = SelectedItem::updateOrCreate(
                    ['selectedItems' => $item['id']], // Kondisi untuk mencari data
                    [
                        'quantity' => $item['quantity'],  // Update jumlah produk
                        'user_id' => $userId,  // Update jumlah produk
                        'TotalHarga' => $item['total'],   // Update total harga
                        'harga' => $item['harga'],        // Update harga per item
                    ]
                );

                // Menambahkan ID ke dalam array orderIds
                $orderIds[] = $item['id'];
            }

            // Debugging untuk melihat array orderIds sebelum return


            // Mengembalikan response sukses dengan URL redirect
            return response()->json([
                'message' => 'Your order has been successfully processed!',
                'redirect_url' => route('ViewCheckout', ['selectedID' => implode(',', $orderIds)]), // Menggabungkan ID menjadi string dan menambahkannya ke URL
            ]);
        } else {
            // Jika tidak ada data keranjang, kembalikan error
            return response()->json([
                'message' => 'No items selected.',
            ], 400); // Status 400 untuk error
        }
    }

    public function Order(Request $request) {}



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
