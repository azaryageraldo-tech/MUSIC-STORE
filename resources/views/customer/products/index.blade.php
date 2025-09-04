<x-app-layout>
    <!-- Hapus header dan gunakan div dengan class khusus untuk menandai bahwa ini adalah halaman tanpa header -->
    <div class="py-6 pb-20 no-header-page"> <!-- Tambahkan class no-header-page -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Judul Panel Pelanggan -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Katalog Produk') }}
                </h2>
                <p class="text-sm text-gray-600">{{ now()->format('l, d F Y') }}</p>
            </div>
            
            <!-- Welcome Banner seperti di dashboard -->
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl shadow-md overflow-hidden mb-8">
                <div class="md:flex">
                    <div class="p-8 md:flex-1">
                        <div class="uppercase tracking-wide text-sm text-indigo-100 font-semibold">Katalog Produk</div>
                        <h1 class="mt-1 text-white text-3xl font-bold">Temukan Alat Musik Favorit Anda</h1>
                        <p class="mt-2 text-indigo-100">Pilih dari berbagai koleksi alat musik berkualitas tinggi untuk kebutuhan Anda.</p>
                    </div>
                    <div class="hidden md:block md:flex-shrink-0">
                        <div class="h-full w-48 flex items-center justify-center bg-indigo-800 bg-opacity-25">
                            <svg class="h-24 w-24 text-white opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Filter dan Pencarian dengan desain yang lebih modern -->
            <div class="bg-white p-6 rounded-xl shadow-sm mb-8 border border-gray-100">
                <form action="{{ route('customer.products.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select id="category" name="category" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Produk</label>
                        <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Nama produk..." class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out flex items-center justify-center">
                            <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Cari
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Hasil Pencarian -->
            <div class="mb-6 flex justify-between items-center">
                <p class="text-gray-600">Menampilkan {{ $products->count() }} dari {{ $products->total() }} produk</p>
                
                @if(request('category') || request('search'))
                    <a href="{{ route('customer.products.index') }}" class="text-indigo-600 hover:text-indigo-800 flex items-center">
                        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Reset Filter
                    </a>
                @endif
            </div>
            
            <!-- Grid Produk dengan desain yang lebih modern -->
            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($products as $product)
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden border border-gray-100 hover:border-indigo-200 transform hover:-translate-y-1">
                        <a href="{{ route('customer.products.show', $product->slug) }}" class="block">
                            <div class="relative">
                                <div class="h-48 w-full overflow-hidden bg-gray-100">
                                    <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/300x300?text=' . $product->name }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                                </div>
                                <div class="absolute top-3 left-3">
                                    <span class="px-2 py-1 text-xs font-medium bg-indigo-600 text-white rounded-full">{{ $product->category->name }}</span>
                                </div>
                            </div>
                        </a>
                        <div class="p-4">
                            <a href="{{ route('customer.products.show', $product->slug) }}" class="block">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2 hover:text-indigo-600 line-clamp-1">{{ $product->name }}</h3>
                            </a>
                            <p class="text-gray-600 mb-4 text-sm line-clamp-2">{{ $product->description }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-xl font-bold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <a href="#" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-150 ease-in-out flex items-center">
                                    <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Beli
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Pagination dengan desain yang lebih modern -->
                <div class="mt-8">
                    {{ $products->withQueryString()->links() }}
                </div>
            @else
                <div class="text-center py-12 bg-white rounded-lg shadow-sm">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <h3 class="text-xl font-medium text-gray-900 mb-2">Tidak ada produk ditemukan</h3>
                    <p class="text-gray-600">Coba ubah filter atau kata kunci pencarian Anda</p>
                </div>
            @endif
        </div>
    </div>
    
    <!-- Footer Navigation Bar - Dipertahankan sesuai permintaan -->
    <div class="fixed bottom-0 left-0 right-0 bg-white shadow-lg border-t border-gray-200 z-50">
        <div class="flex justify-around items-center py-2">
            <a href="{{ route('dashboard') }}" class="flex flex-col items-center p-2 text-gray-500 hover:text-indigo-600">
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
            <a href="{{ route('customer.products.index') }}" class="flex flex-col items-center p-2 text-indigo-600">
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