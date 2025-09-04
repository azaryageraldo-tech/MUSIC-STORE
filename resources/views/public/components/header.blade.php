<!-- Header/Navbar -->
<header class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="/" class="flex items-center">
                    <svg class="h-8 w-8 text-indigo-600" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"/>
                        <path d="M9 19c-4.274 0 -7.164 -2.548 -7.26 -7.501a5.13 5.13 0 0 1 5.26 -5.022c2.09 .255 3.896 1.636 4.9 3.481c1.004 -1.845 2.81 -3.226 4.9 -3.481a5.13 5.13 0 0 1 5.26 5.022c-.096 4.953 -2.986 7.501 -7.26 7.501c-2.269 0 -4.21 -1.02 -5.5 -2.5c-1.29 1.48 -3.231 2.5 -5.5 2.5z" />
                    </svg>
                    <span class="text-xl font-bold text-gray-900 ml-2">{{ $store_settings->store_name ?? 'Toko Musik' }}</span>
                </a>
            </div>
            <div class="hidden sm:flex sm:items-center sm:space-x-8">
                <a href="/" class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition duration-150 ease-in-out">Beranda</a>
                <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition duration-150 ease-in-out">Katalog Produk</a>
                <a href="/#kontak" class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition duration-150 ease-in-out">Kontak</a>
            </div>
            <div class="flex items-center space-x-4">
                <a href="/cart" class="text-gray-700 hover:text-indigo-600 relative">
                    <i class="fas fa-shopping-cart text-xl"></i>
                    <span class="absolute -top-2 -right-2 bg-indigo-600 text-white rounded-full text-xs w-5 h-5 flex items-center justify-center">0</span>
                </a>
                @if (Route::has('login'))
                    <div>
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-indigo-600"><i class="fas fa-user-circle text-xl"></i></a>
                        @else
                            <a href="{{ route('login') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">Masuk</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-indigo-600 hover:text-indigo-800 px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">Daftar</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
            <!-- Mobile menu button -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out" aria-controls="mobile-menu" aria-expanded="false" x-data="{ open: false }" @click="open = !open">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu" x-show="open" style="display: none;">
        <div class="pt-2 pb-3 space-y-1">
            <a href="/" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 transition duration-150 ease-in-out">Beranda</a>
            <a href="{{ route('products.index') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 transition duration-150 ease-in-out">Katalog Produk</a>
            <a href="/#kategori" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 transition duration-150 ease-in-out">Kategori</a>
            <a href="/#kontak" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 transition duration-150 ease-in-out">Kontak</a>
        </div>
    </div>
</header>