@extends('layouts.admin')

@section('header')
    <div class="flex items-center justify-between py-4">
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.orders.index') }}" class="bg-white text-gray-500 hover:text-gray-700 p-2 rounded-full border border-gray-200 hover:border-gray-300 transition-colors duration-150 ease-in-out">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div class="flex flex-col">
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">Detail Pesanan</h2>
                <p class="text-sm text-gray-500">#{{ $order->order_number }}</p>
            </div>
        </div>
        <div class="flex items-center space-x-2">
            @php
                $statusClass = [
                    'baru' => 'bg-blue-100 text-blue-800 border border-blue-200',
                    'diproses' => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                    'dikirim' => 'bg-indigo-100 text-indigo-800 border border-indigo-200',
                    'selesai' => 'bg-green-100 text-green-800 border border-green-200',
                    'dibatalkan' => 'bg-red-100 text-red-800 border border-red-200',
                ][$order->status] ?? 'bg-gray-100 text-gray-800 border border-gray-200';
            @endphp
            <span class="px-3 py-1.5 inline-flex items-center text-sm font-medium rounded-full {{ $statusClass }}">
                {{ ucfirst($order->status) }}
            </span>
            <span class="text-sm text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</span>
        </div>
    </div>
@endsection

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md flex items-center" role="alert">
                <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Kolom Utama -->
            <div class="md:col-span-2 space-y-6">
                <!-- Detail Produk -->
                <div class="bg-white shadow-md rounded-xl overflow-hidden">
                    <div class="px-6 py-4 border-b bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <svg class="h-5 w-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            Produk yang Dipesan
                        </h3>
                    </div>
                    <div class="p-6">
                        <table class="min-w-full">
                            <thead>
                                <tr class="bg-gray-50 rounded-lg">
                                    <th class="text-left py-3 px-4 text-xs font-medium text-gray-500 uppercase tracking-wider rounded-l-lg">Produk</th>
                                    <th class="text-center py-3 px-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                                    <th class="text-right py-3 px-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                    <th class="text-right py-3 px-4 text-xs font-medium text-gray-500 uppercase tracking-wider rounded-r-lg">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->products as $product)
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors duration-150 ease-in-out">
                                    <td class="py-4 px-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-gray-100 rounded-md flex items-center justify-center text-gray-500">
                                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                                <div class="text-xs text-gray-500">SKU: {{ $product->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center py-4 px-4">
                                        <span class="px-2.5 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-medium">{{ $product->pivot->quantity }}</span>
                                    </td>
                                    <td class="text-right py-4 px-4 text-sm">Rp {{ number_format($product->pivot->price, 0, ',', '.') }}</td>
                                    <td class="text-right py-4 px-4 text-sm font-medium">Rp {{ number_format($product->pivot->quantity * $product->pivot->price, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                                <tr class="bg-gray-50">
                                    <td colspan="3" class="text-right py-4 px-4 font-medium">Total</td>
                                    <td class="text-right py-4 px-4 text-indigo-700 font-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Bukti Pembayaran -->
                <div class="bg-white shadow-md rounded-xl overflow-hidden">
                    <div class="px-6 py-4 border-b bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <svg class="h-5 w-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Bukti Pembayaran
                        </h3>
                    </div>
                    <div class="p-6">
                        @if($order->payment_proof)
                            <div class="relative group">
                                <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti Pembayaran" class="max-w-full h-auto rounded-lg border border-gray-200 shadow-sm">
                                <div class="absolute inset-0 bg-indigo-600 bg-opacity-0 group-hover:bg-opacity-10 flex items-center justify-center transition-all duration-200 rounded-lg">
                                    <div class="opacity-0 group-hover:opacity-100 bg-white p-2 rounded-full shadow-md">
                                        <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="flex flex-col items-center justify-center py-10 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                <svg class="h-12 w-12 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-gray-500 text-center">Pelanggan belum mengunggah bukti pembayaran.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Kolom Samping -->
            <div class="md:col-span-1 space-y-6">
                <!-- Detail Pelanggan -->
                <div class="bg-white shadow-md rounded-xl overflow-hidden">
                    <div class="px-6 py-4 border-b bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <svg class="h-5 w-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Detail Pelanggan
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">{{ $order->customer_name }}</p>
                                <p class="text-xs text-gray-500">Pelanggan</p>
                            </div>
                        </div>
                        
                        <div class="pt-2">
                            <div class="flex items-center py-2">
                                <div class="flex-shrink-0 text-gray-400">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-gray-900">{{ $order->customer_email }}</p>
                                    <p class="text-xs text-gray-500">Email</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center py-2">
                                <div class="flex-shrink-0 text-gray-400">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-gray-900">{{ $order->customer_phone }}</p>
                                    <p class="text-xs text-gray-500">Telepon</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start py-2">
                                <div class="flex-shrink-0 text-gray-400 mt-1">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-gray-900">{{ $order->shipping_address }}</p>
                                    <p class="text-xs text-gray-500">Alamat Pengiriman</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Update Status -->
                <div class="bg-white shadow-md rounded-xl overflow-hidden">
                    <div class="px-6 py-4 border-b bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <svg class="h-5 w-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Update Status Pesanan
                        </h3>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select id="status" name="status" class="block w-full pl-3 pr-10 py-2.5 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-lg transition-colors duration-150 ease-in-out">
                                    <option value="baru" @if($order->status == 'baru') selected @endif>Baru</option>
                                    <option value="diproses" @if($order->status == 'diproses') selected @endif>Diproses</option>
                                    <option value="dikirim" @if($order->status == 'dikirim') selected @endif>Dikirim</option>
                                    <option value="selesai" @if($order->status == 'selesai') selected @endif>Selesai</option>
                                    <option value="dibatalkan" @if($order->status == 'dibatalkan') selected @endif>Dibatalkan</option>
                                </select>
                            </div>
                            <div class="mt-5">
                                <button type="submit" class="w-full inline-flex justify-center items-center py-2.5 px-4 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-150 ease-in-out">
                                    <svg class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Update Status
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="mt-6 text-center">
                    <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center text-sm text-indigo-600 hover:text-indigo-900 font-medium">
                        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Daftar Pesanan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

