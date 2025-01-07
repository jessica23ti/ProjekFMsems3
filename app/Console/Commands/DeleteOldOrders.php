<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pemesanan;
use Carbon\Carbon;

class DeleteOldOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-old-orders';

    /**
     * The console command description.
     *
     * @var string
     */  protected $description = 'Hapus pesanan yang sudah lebih dari 7 hari';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Ambil data pesanan yang sudah lebih dari 7 hari
        Pemesanan::where('status_pesan', 'pending') // Memfilter status "pending"
            ->where('created_at', '<', Carbon::now()->subDays(7)) // Memfilter tanggal lebih dari 7 hari
            ->delete();

        $this->info('Pesanan pending yang lebih dari 7 hari telah dihapus!');
    }
}
