<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\SelectedItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
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
    public function processOrderUpdate(Request $request)
    {
        // Ambil ongkir dari request
        $ongkir = $request->input('ongkir');

        // Cari user yang sedang login
        // $user = Auth::user();

        // Cari semua selectedID yang terkait dengan user yang sedang login
        // Misalkan tabel 'orders' memiliki relasi dengan tabel 'users' dan menyimpan selectedID ddddddd==> where('user_id', $user->id)
        $orders = SelectedItem::whereNotNull('selectedItems')  // Pastikan ada selected_id
            ->get(); // Mengambil semua data order yang ada

        // Update ongkir untuk setiap order yang ditemukan
        foreach ($orders as $order) {
            $order->ongkir = $ongkir;  // Atur ongkir baru
            $order->save();  // Simpan perubahan
        }

        // Kembalikan response dengan pesan
        return response()->json([
            'message' => 'Your order has been successfully processed! Ongkir updated for selected orders.',
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
