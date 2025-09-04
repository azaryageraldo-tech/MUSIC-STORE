<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Models\Order;
    use Illuminate\Http\Request;

    class OrderController extends Controller
    {
        /**
         * Menampilkan daftar semua pesanan.
         */
        public function index()
        {
            $orders = Order::with('user')->latest()->paginate(10);
            return view('admin.orders.index', compact('orders'));
        }

        /**
         * Menampilkan detail satu pesanan.
         */
        public function show(Order $order)
        {
            // Eager load relasi products
            $order->load('products');
            return view('admin.orders.show', compact('order'));
        }

        /**
         * Memperbarui status pesanan.
         */
        public function updateStatus(Request $request, Order $order)
        {
            $request->validate([
                'status' => 'required|in:baru,diproses,dikirim,selesai,dibatalkan',
            ]);

            $order->update(['status' => $request->status]);

            return redirect()->route('admin.orders.show', $order)->with('success', 'Status pesanan berhasil diperbarui.');
        }
    }
    
