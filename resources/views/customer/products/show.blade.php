<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Produk') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <div class="mb-6">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-indigo-600">
                                <i class="fas fa-home mr-2"></i>
                                Beranda
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 text-sm mx-2"></i>
                                <a href="{{ route('customer.products.index') }}" class="text-sm font-medium text-gray-700 hover:text-indigo-600">Katalog Produk</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 text-sm mx-2"></i>
                                <span class="text-sm font-medium text-gray-500">{{ $product->name }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Detail Produk -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Gambar Produk -->
                        <div class="rounded-lg overflow-hidden">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/600x400?text=' . $product->name }}" alt="{{ $product->name }}" class="w-full h-auto object-cover">
                        </div>
                        
                        <!-- Informasi Produk -->
                        <div>
                            <div class="mb-2">
                                <span class="inline-block bg-indigo-100 text-indigo-800 text-sm font-medium px-3 py-1 rounded-full">{{ $product->category->name }}</span>
                            </div>
                            <h1 class="text-2xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
                            <div class="text-3xl font-bold text-gray-900 mb-6">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Deskripsi</h3>
                                <div class="text-gray-600 space-y-2">
                                    <p>{{ $product->description }}</p>
                                </div>
                            </div>
                            
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Stok</h3>
                                <p class="text-gray-600">{{ $product->stock }} tersedia</p>
                            </div>
                            
                            <div class="flex space-x-4">
                                <button type="button" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-6 rounded-lg transition duration-150 ease-in-out">
                                    <i class="fas fa-shopping-cart mr-2"></i> Tambah ke Keranjang
                                </button>
                                <button type="button" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 px-4 rounded-lg transition duration-150 ease-in-out">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Produk Terkait -->
            @if($relatedProducts->count() > 0)
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Produk Terkait</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $relatedProduct)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                        <a href="{{ route('customer.products.show', $relatedProduct->slug) }}" class="block">
                            <div class="relative">
                                <div class="h-48 w-full overflow-hidden">
                                    <img src="{{ $relatedProduct->image ? asset('storage/' . $relatedProduct->image) : 'https://via.placeholder.com/300x300?text=' . $relatedProduct->name }}" alt="{{ $relatedProduct->name }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                                </div>
                            </div>
                        </a>
                        <div class="p-4">
                            <a href="{{ route('customer.products.show', $relatedProduct->slug) }}" class="block">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2 hover:text-indigo-600">{{ $relatedProduct->name }}</h3>
                            </a>
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-gray-900">Rp {{ number_format($relatedProduct->price, 0, ',', '.') }}</span>
                                <a href="#" class="text-indigo-600 hover:text-indigo-800">
                                    <i class="fas fa-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Footer Navigation untuk Mobile -->
    <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 py-3 px-4 md:hidden">
        <div class="flex justify-around items-center">
            <a href="{{ route('dashboard') }}" class="flex flex-col items-center text-gray-500 hover:text-indigo-600 {{ request()->routeIs('dashboard') ? 'text-indigo-600' : '' }}">
                <i class="fas fa-home text-lg"></i>
                <span class="text-xs mt-1">Beranda</span>
            </a>
            <a href="#orders" class="flex flex-col items-center text-gray-500 hover:text-indigo-600">
                <i class="fas fa-shopping-bag text-lg"></i>
                <span class="text-xs mt-1">Pesanan</span>
            </a>
            <a href="{{ route('customer.products.index') }}" class="flex flex-col items-center text-indigo-600">
                <i class="fas fa-store text-lg"></i>
                <span class="text-xs mt-1">Produk</span>
            </a>
            <a href="{{ route('profile.edit') }}" class="flex flex-col items-center text-gray-500 hover:text-indigo-600 {{ request()->routeIs('profile.edit') ? 'text-indigo-600' : '' }}">
                <i class="fas fa-user text-lg"></i>
                <span class="text-xs mt-1">Profil</span>
            </a>
        </div>
    </div>
</x-app-layout>