@extends('public.layouts.main')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="/" class="text-gray-700 hover:text-indigo-600">
                        <i class="fas fa-home mr-2"></i> Beranda
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2 text-sm"></i>
                        <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-indigo-600">Produk</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2 text-sm"></i>
                        <a href="{{ route('products.index', ['category' => $product->category_id]) }}" class="text-gray-700 hover:text-indigo-600">{{ $product->category->name }}</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2 text-sm"></i>
                        <span class="text-gray-500">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>
        
        <!-- Detail Produk -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-0">
                <!-- Gambar Produk -->
                <div class="p-6 flex items-center justify-center bg-gray-50">
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/600x600?text=' . $product->name }}" alt="{{ $product->name }}" class="max-w-full max-h-[500px] object-contain">
                </div>
                
                <!-- Informasi Produk -->
                <div class="p-8">
                    <span class="inline-block bg-indigo-100 text-indigo-800 text-sm font-medium px-3 py-1 rounded-full mb-4">{{ $product->category->name }}</span>
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
                    
                    <div class="flex items-center mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                            <i class="fas fa-star-half-alt text-yellow-400"></i>
                        </div>
                        <span class="text-gray-600 ml-2">4.8 (120 ulasan)</span>
                    </div>
                    
                    <div class="text-3xl font-bold text-gray-900 mb-6">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    
                    <div class="prose prose-indigo max-w-none mb-8">
                        <p>{{ $product->description }}</p>
                    </div>
                    
                    <div class="mb-8">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span class="text-gray-700">Stok tersedia: {{ $product->stock }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-truck text-indigo-500 mr-2"></i>
                            <span class="text-gray-700">Pengiriman cepat ke seluruh Indonesia</span>
                        </div>
                    </div>
                    
                    <div class="flex space-x-4">
                        <div class="w-1/3">
                            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
                            <input type="number" id="quantity" name="quantity" min="1" max="{{ $product->stock }}" value="1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div class="w-2/3">
                            <button type="button" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-4 rounded-md transition duration-150 ease-in-out flex items-center justify-center">
                                <i class="fas fa-shopping-cart mr-2"></i> Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Produk Terkait -->
        @if($relatedProducts->count() > 0)
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Produk Terkait</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                    <a href="{{ route('products.show', $related->slug) }}" class="block">
                        <div class="h-48 w-full overflow-hidden">
                            <img src="{{ $related->image ? asset('storage/' . $related->image) : 'https://via.placeholder.com/300x300?text=' . $related->name }}" alt="{{ $related->name }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                        </div>
                    </a>
                    <div class="p-4">
                        <span class="text-xs font-medium text-indigo-600">{{ $related->category->name }}</span>
                        <a href="{{ route('products.show', $related->slug) }}" class="block">
                            <h3 class="text-base font-semibold text-gray-900 mb-2 hover:text-indigo-600 line-clamp-1">{{ $related->name }}</h3>
                        </a>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-gray-900">Rp {{ number_format($related->price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection