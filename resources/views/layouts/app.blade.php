<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 flex flex-col">
            <!-- Navigasi hanya ditampilkan di halaman selain dashboard -->
            @if(!request()->routeIs('dashboard'))
                @include('layouts.navigation')
            @endif

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    {{ $slot }}
                </div>
            </main>
            
            <!-- Desktop Footer - Disembunyikan di halaman dashboard -->
            @if(!request()->routeIs('dashboard'))
                <footer class="bg-white border-t border-gray-200 py-6 hidden md:block">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-3">{{ config('app.name', 'Toko Musik') }}</h3>
                                <p class="text-gray-600 mb-3">Toko alat musik terlengkap dengan kualitas terbaik dan harga terjangkau.</p>
                                <div class="flex space-x-4">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-800 transition duration-150 ease-in-out">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#" class="text-indigo-600 hover:text-indigo-800 transition duration-150 ease-in-out">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="#" class="text-indigo-600 hover:text-indigo-800 transition duration-150 ease-in-out">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-3">Navigasi Cepat</h3>
                                <ul class="space-y-2">
                                    <li><a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-indigo-600 transition duration-150 ease-in-out">Dashboard</a></li>
                                    <li><a href="#orders" class="text-gray-600 hover:text-indigo-600 transition duration-150 ease-in-out">Pesanan Saya</a></li>
                                    <li><a href="{{ route('products.index') }}" class="text-gray-600 hover:text-indigo-600 transition duration-150 ease-in-out">Katalog Produk</a></li>
                                    <li><a href="{{ route('profile.edit') }}" class="text-gray-600 hover:text-indigo-600 transition duration-150 ease-in-out {{ request()->routeIs('profile.edit') ? 'text-indigo-600 font-medium' : '' }}">Profil</a></li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-3">Bantuan</h3>
                                <ul class="space-y-2">
                                    <li><a href="#cara-pembelian" class="text-gray-600 hover:text-indigo-600 transition duration-150 ease-in-out">Cara Pembelian</a></li>
                                    <li><a href="#pengiriman" class="text-gray-600 hover:text-indigo-600 transition duration-150 ease-in-out">Pengiriman</a></li>
                                    <li><a href="#faq" class="text-gray-600 hover:text-indigo-600 transition duration-150 ease-in-out">FAQ</a></li>
                                    <li><a href="#kontak" class="text-gray-600 hover:text-indigo-600 transition duration-150 ease-in-out">Kontak</a></li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-3">Kontak</h3>
                                <ul class="space-y-2">
                                    <li class="flex items-start">
                                        <i class="fas fa-map-marker-alt mt-1 mr-3 text-indigo-600"></i>
                                        <span class="text-gray-600">Jl. Musik Raya No. 123, Jakarta</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-phone-alt mt-1 mr-3 text-indigo-600"></i>
                                        <span class="text-gray-600">(021) 1234-5678</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-envelope mt-1 mr-3 text-indigo-600"></i>
                                        <span class="text-gray-600">info@tokomusik.com</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="border-t border-gray-200 mt-8 pt-6 text-center text-gray-600">
                            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Toko Musik') }}. All rights reserved.</p>
                        </div>
                    </div>
                </footer>
            @endif
            
            <!-- Mobile Footer Navigation - Disembunyikan di halaman dashboard -->
            @if(!request()->routeIs('dashboard'))
                <div class="md:hidden fixed bottom-0 left-0 right-0 bg-white shadow-lg border-t border-gray-200 z-50">
                    <div class="flex justify-around items-center py-2">
                        <a href="{{ route('dashboard') }}" class="flex flex-col items-center p-2 {{ request()->routeIs('dashboard') ? 'text-indigo-600' : 'text-gray-500 hover:text-indigo-600' }}">
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
                        <a href="{{ route('products.index') }}" class="flex flex-col items-center p-2 {{ request()->routeIs('products.index') ? 'text-indigo-600' : 'text-gray-500 hover:text-indigo-600' }}">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span class="text-xs mt-1">Produk</span>
                        </a>
                        <a href="{{ route('profile.edit') }}" class="flex flex-col items-center p-2 {{ request()->routeIs('profile.edit') ? 'text-indigo-600' : 'text-gray-500 hover:text-indigo-600' }}">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="text-xs mt-1">Profil</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </body>
</html>
