<x-app-layout>
    <div class="py-6 pb-20"> <!-- Tambahkan padding bottom untuk memberi ruang pada footer -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Judul Panel Pelanggan -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Panel Pelanggan') }}
                </h2>
                <p class="text-sm text-gray-600">{{ now()->format('l, d F Y') }}</p>
            </div>
            
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl shadow-md overflow-hidden mb-8">
                <div class="md:flex">
                    <div class="p-8 md:flex-1">
                        <div class="uppercase tracking-wide text-sm text-indigo-100 font-semibold">Selamat Datang Kembali</div>
                        <h1 class="mt-1 text-white text-3xl font-bold">{{ Auth::user()->name }}</h1>
                        <p class="mt-2 text-indigo-100">Kelola pesanan dan profil Anda dengan mudah melalui panel pelanggan.</p>
                        <div class="mt-4">
                            <a href="{{ route('profile.edit') }}" class="inline-block bg-white text-indigo-600 hover:bg-indigo-50 rounded-lg px-4 py-2 text-sm font-medium transition duration-150 ease-in-out">
                                Edit Profil
                            </a>
                        </div>
                    </div>
                    <div class="hidden md:block md:flex-shrink-0">
                        <div class="h-full w-48 flex items-center justify-center bg-indigo-800 bg-opacity-25">
                            <svg class="h-24 w-24 text-white opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Profil Saya -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden border border-gray-100">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="p-3 rounded-lg bg-blue-500 bg-opacity-10">
                                <svg class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div class="ml-5">
                                <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Profil Saya</p>
                                <p class="text-2xl font-bold text-gray-800 mt-1">{{ Auth::user()->name }}</p>
                            </div>
                        </div>
                        <div class="mt-4 border-t border-gray-100 pt-4">
                            <a href="{{ route('profile.edit') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                Edit Profil
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Pesanan Saya -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden border border-gray-100">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="p-3 rounded-lg bg-green-500 bg-opacity-10">
                                <svg class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </div>
                            <div class="ml-5">
                                <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Pesanan Saya</p>
                                <p class="text-2xl font-bold text-gray-800 mt-1">{{ Auth::user()->orders->count() ?? 0 }}</p>
                            </div>
                        </div>
                        <div class="mt-4 border-t border-gray-100 pt-4">
                            <a href="#" class="text-green-600 hover:text-green-800 text-sm font-medium flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                                Lihat Semua Pesanan
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Alamat Pengiriman -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden border border-gray-100">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="p-3 rounded-lg bg-purple-500 bg-opacity-10">
                                <svg class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="ml-5">
                                <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Alamat Pengiriman</p>
                                <p class="text-2xl font-bold text-gray-800 mt-1">{{ Auth::user()->shipping_address ? 'Tersedia' : 'Belum Ada' }}</p>
                            </div>
                        </div>
                        <div class="mt-4 border-t border-gray-100 pt-4">
                            <a href="{{ route('profile.edit') }}" class="text-purple-600 hover:text-purple-800 text-sm font-medium flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                {{ Auth::user()->shipping_address ? 'Edit Alamat' : 'Tambah Alamat' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pesanan Terbaru -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 mb-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">Pesanan Terbaru</h3>
                    <a href="#" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium transition duration-150 ease-in-out">Lihat Semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-50">
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">
                                    ID Pesanan
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tr-lg">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse(Auth::user()->orders()->latest()->take(5)->get() as $order)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-indigo-600">
                                        #{{ $order->id ?? 'ORD'.rand(10000, 99999) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $order->created_at->format('d M Y') ?? now()->subDays(rand(1, 10))->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Rp {{ number_format($order->total ?? rand(100000, 5000000), 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statuses = ['Selesai', 'Dikirim', 'Diproses', 'Menunggu Pembayaran'];
                                            $colors = ['green', 'blue', 'yellow', 'gray'];
                                            $index = $order->status_index ?? array_rand($statuses);
                                            $status = $statuses[$index];
                                            $color = $colors[$index];
                                        @endphp
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $color }}-100 text-{{ $color }}-800">
                                            {{ $status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 whitespace-nowrap text-sm text-gray-500 text-center bg-gray-50">
                                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                        </svg>
                                        <p class="font-medium">Belum ada pesanan</p>
                                        <p class="text-gray-400 mt-1">Pesanan Anda akan muncul di sini</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Bagian Produk Terbaru dihapus sesuai permintaan -->
            
        </div>
    </div>
    
    <!-- Footer Navigation Bar -->
    <div class="fixed bottom-0 left-0 right-0 bg-white shadow-lg border-t border-gray-200 z-50">
        <div class="flex justify-around items-center py-2">
            <a href="{{ route('dashboard') }}" class="flex flex-col items-center p-2 text-indigo-600">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-xs mt-1">Beranda</span>
            </a>
            <a href="#orders" class="flex flex-col items-center p-2 text-gray-500 hover:text-indigo-600">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <span class="text-xs mt-1">Pesanan</span>
            </a>
            <a href="{{ route('customer.products.index') }}" class="flex flex-col items-center p-2 text-gray-500 hover:text-indigo-600">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span class="text-xs mt-1">Katalog</span>
            </a>
            <a href="{{ route('profile.edit') }}" class="flex flex-col items-center p-2 text-gray-500 hover:text-indigo-600">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="text-xs mt-1">Profil</span>
            </a>
        </div>
    </div>
</x-app-layout>
