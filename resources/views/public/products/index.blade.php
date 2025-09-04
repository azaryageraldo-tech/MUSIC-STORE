@extends('public.layouts.main')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Katalog Produk</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Temukan berbagai alat musik berkualitas untuk kebutuhan Anda</p>
        </div>
        
        <!-- Filter dan Pencarian -->
        <div class="bg-white p-6 rounded-lg shadow-sm mb-8" data-aos="fade-up">
            <form action="{{ route('products.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
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
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">
                        <i class="fas fa-search mr-2"></i> Cari
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Hasil Pencarian -->
        <div class="mb-6 flex justify-between items-center">
            <p class="text-gray-600">Menampilkan {{ $products->count() }} dari {{ $products->total() }} produk</p>
            
            @if(request('category') || request('search'))
                <a href="{{ route('products.index') }}" class="text-indigo-600 hover:text-indigo-800">
                    <i class="fas fa-times-circle mr-1"></i> Reset Filter
                </a>
            @endif
        </div>
        
        <!-- Grid Produk -->
        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($products as $product)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
                    <a href="{{ route('products.show', $product->slug) }}" class="block">
                        <div class="relative">
                            <div class="h-64 w-full overflow-hidden">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/300x300?text=' . $product->name }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                            </div>
                        </div>
                    </a>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-indigo-600">{{ $product->category->name }}</span>
                        </div>
                        <a href="{{ route('products.show', $product->slug) }}" class="block">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 hover:text-indigo-600">{{ $product->name }}</h3>
                        </a>
                        <p class="text-gray-600 mb-4 line-clamp-2">{{ $product->description }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            <a href="#" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-150 ease-in-out">
                                <i class="fas fa-shopping-cart mr-2"></i> Beli
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="mt-12">
                {{ $products->withQueryString()->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-search text-5xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-medium text-gray-900 mb-2">Tidak ada produk ditemukan</h3>
                <p class="text-gray-600">Coba ubah filter atau kata kunci pencarian Anda</p>
            </div>
        @endif
    </div>
</div>
@endsection