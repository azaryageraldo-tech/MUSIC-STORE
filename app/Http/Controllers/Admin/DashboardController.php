<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dasbor admin.
     */
    public function index()
    {
        // Data tiruan untuk dasbor, nanti akan kita ganti dengan data asli
        $totalSales = 75500000;
        $newOrders = 12;
        $topProducts = [
            ['name' => 'Gitar Akustik Yamaha F310', 'category' => 'Gitar', 'sold' => 150],
            ['name' => 'Keyboard Casio CT-S1', 'category' => 'Keyboard', 'sold' => 95],
            ['name' => 'Drum Elektrik Roland TD-07DMK', 'category' => 'Drum', 'sold' => 60],
            ['name' => 'Biola Cremona SV-75', 'category' => 'Biola', 'sold' => 45],
        ];

        // Kirim data ke view menggunakan compact()
        return view('admin.dashboard', compact('totalSales', 'newOrders', 'topProducts'));
    }
}