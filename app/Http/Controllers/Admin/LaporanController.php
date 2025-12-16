<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Filter tanggal
        $start = $request->input('start', date('Y-m-01')); // default awal bulan
        $end   = $request->input('end', date('Y-m-d'));    // default hari ini

        // Total transaksi
        $totalTransaksi = Transaction::whereBetween('created_at', [$start.' 00:00:00', $end.' 23:59:59'])->count();

        // Total penjualan
        $totalPenjualan = Transaction::whereBetween('created_at', [$start.' 00:00:00', $end.' 23:59:59'])
            ->sum('total');

        // Produk terlaris
        $produkTerlaris = TransactionDetail::select('product_id', 
                                    DB::raw('SUM(qty) as total_qty'), 
                                    DB::raw('SUM(subtotal) as total_penjualan'))
            ->whereHas('transaction', function($q) use ($start, $end) {
                $q->whereBetween('created_at', [$start.' 00:00:00', $end.' 23:59:59']);
            })
            ->with('product')
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->get();

        return view('admin.laporan.index', compact(
            'start', 'end', 'totalTransaksi', 'totalPenjualan', 'produkTerlaris'
        ));
    }
}
