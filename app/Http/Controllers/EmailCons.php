<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Mail\EmailAfterCO;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailCons extends Controller
{
    public function gerr()
    {
        return view('components.product-section');
    }
    public function index()
    {
        return view('email.email');
    }
    public function sendEmail()
    {
        $id = Auth::id();
        $order = Pemesanan::where('user_id', $id) // Filter berdasarkan user_id
            ->latest('id') // Urutkan berdasarkan kolom 'id' (bisa 'created_at' jika sesuai kebutuhan)
            ->first(); // Ambil data pertama (terbaru)
        $data = [
            'text' => 'Terima Kasih Sudah berbelanja!',
            'order_id' => $order->id,
            'tgl' => $order->updated_at,

        ];

        $email_target = "jessicanathania72@gmail.com";
        Mail::to($email_target)->send(new EmailAfterCO($data));
        return redirect()->route('email')->with('pesan', 'email berhasil dikirim');
    }
}
