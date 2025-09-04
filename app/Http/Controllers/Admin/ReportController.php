<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Menampilkan halaman laporan penjualan.
     */
    public function index(Request $request)
    {
        // 1. Riwayat Transaksi (hanya pesanan yang statusnya 'selesai')
        $transactions = Order::where('status', 'selesai')
            ->latest()
            ->paginate(10);

        // 2. Data Penjualan Harian (7 hari terakhir)
        $dailySales = Order::where('status', 'selesai')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get([
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_amount) as total')
            ]);

        // 3. Data Penjualan Bulanan (12 bulan terakhir)
        $monthlySales = Order::where('status', 'selesai')
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->get([
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('SUM(total_amount) as total')
            ]);

        return view('admin.reports.index', compact('transactions', 'dailySales', 'monthlySales'));
    }
}
