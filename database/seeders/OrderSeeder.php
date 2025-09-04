<?php

    namespace Database\Seeders;

    use App\Models\Order;
    use App\Models\Product;
    use App\Models\User;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Str;

    class OrderSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            // Ambil beberapa user dan produk yang sudah ada
            $customers = User::where('role', 'pelanggan')->get();
            $products = Product::all();

            if ($customers->isEmpty() || $products->count() < 2) {
                $this->command->info('Tidak ada cukup pelanggan atau produk untuk membuat pesanan.');
                return;
            }

            // Buat 5 pesanan palsu
            for ($i = 0; $i < 5; $i++) {
                $customer = $customers->random();
                $product1 = $products->random();
                $product2 = $products->where('id', '!=', $product1->id)->random();

                $totalAmount = ($product1->price * 1) + ($product2->price * 2);

                $order = Order::create([
                    'user_id' => $customer->id,
                    'order_number' => 'INV-' . strtoupper(Str::random(10)),
                    'total_amount' => $totalAmount,
                    'status' => ['baru', 'diproses', 'dikirim', 'selesai'][rand(0, 3)],
                    'customer_name' => $customer->name,
                    'customer_email' => $customer->email,
                    'customer_phone' => '08123456789' . $i,
                    'shipping_address' => 'Jalan Contoh No. ' . ($i + 1) . ', Jakarta',
                ]);

                // Lampirkan produk ke pesanan
                $order->products()->attach([
                    $product1->id => ['quantity' => 1, 'price' => $product1->price],
                    $product2->id => ['quantity' => 2, 'price' => $product2->price],
                ]);
            }
        }
    }
    
