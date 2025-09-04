@extends('layouts.admin')

@section('header')
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <svg class="h-8 w-8 text-indigo-600 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
            </svg>
            <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
                Manajemen Produk
            </h2>
        </div>
        <p class="text-sm text-gray-500">Total: {{ $products->total() }} produk</p>
    </div>
@endsection

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Alert Dinamis --}}
        <div id="alert-container">
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-sm flex items-center justify-between" role="alert" id="success-alert">
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-green-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p>{{ session('success') }}</p>
                    </div>
                    <button type="button" class="text-green-500 hover:text-green-700" onclick="document.getElementById('success-alert').style.display='none'">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md shadow-sm flex items-center justify-between" role="alert" id="error-alert">
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-red-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <p>{{ session('error') }}</p>
                    </div>
                    <button type="button" class="text-red-500 hover:text-red-700" onclick="document.getElementById('error-alert').style.display='none'">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif
        </div>

        {{-- Control Bar: Search, Filter, dan Tombol Tambah --}}
        <div class="mb-6 bg-white p-4 rounded-lg shadow-sm">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <div class="relative w-full md:w-1/3">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input type="search" placeholder="Cari produk..." class="pl-10 pr-4 py-2 w-full border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <select class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <a href="{{ route('admin.products.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Tambah Produk Baru
                    </a>
                </div>
            </div>
        </div>

        {{-- Product Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($products as $product)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-1 transition-transform duration-300 border border-gray-100 hover:border-indigo-100 hover:shadow-xl">
                    <a href="{{ route('admin.products.show', $product) }}" class="block relative">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <svg class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-2 right-2">
                            @if($product->stock > 10)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Stok Tersedia
                                </span>
                            @elseif($product->stock > 0)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    Stok Terbatas
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Stok Habis
                                </span>
                            @endif
                        </div>
                    </a>
                    <div class="p-4">
                        <span class="inline-block bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded-full mb-2">{{ $product->category->name }}</span>
                        <h3 class="text-lg font-bold text-gray-900 truncate">{{ $product->name }}</h3>
                        <p class="text-xl font-semibold text-gray-800 mt-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        
                        <div class="mt-2 flex items-center">
                            @if($product->stock > 10)
                                <span class="h-3 w-3 rounded-full bg-green-500"></span>
                            @elseif($product->stock > 0)
                                <span class="h-3 w-3 rounded-full bg-yellow-500"></span>
                            @else
                                <span class="h-3 w-3 rounded-full bg-red-500"></span>
                            @endif
                            <span class="ml-2 text-sm text-gray-600">Stok: {{ $product->stock }}</span>
                        </div>
                    </div>
                    <div class="px-4 pb-4 border-t border-gray-200 pt-3 bg-gray-50 flex items-center justify-end space-x-2">
                         <a href="{{ route('admin.products.show', $product) }}" class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 text-xs font-bold uppercase rounded-full hover:bg-green-200 transition-colors duration-200">
                            <svg class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Detail
                         </a>
                         <a href="{{ route('admin.products.edit', $product) }}" class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 text-xs font-bold uppercase rounded-full hover:bg-blue-200 transition-colors duration-200">
                            <svg class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit
                         </a>
                         <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-100 text-red-800 text-xs font-bold uppercase rounded-full hover:bg-red-200 transition-colors duration-200">
                                <svg class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white rounded-lg shadow p-8 text-center">
                    <svg class="h-12 w-12 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <p class="text-gray-500 mb-4">Belum ada produk yang ditambahkan.</p>
                    <a href="{{ route('admin.products.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Tambah Produk Pertama
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-8 bg-white p-4 rounded-lg shadow-sm">
            {{ $products->links() }}
        </div>

        {{-- Script untuk Alert --}}
        <script>
            // Auto-hide alert after 5 seconds
            setTimeout(function() {
                const successAlert = document.getElementById('success-alert');
                const errorAlert = document.getElementById('error-alert');
                
                if (successAlert) {
                    successAlert.style.display = 'none';
                }
                
                if (errorAlert) {
                    errorAlert.style.display = 'none';
                }
            }, 5000);
            
            // Function to show custom alert
            function showAlert(message, type = 'success') {
                const alertContainer = document.getElementById('alert-container');
                const alertId = 'custom-alert-' + Date.now();
                const alertColor = type === 'success' ? 'green' : 'red';
                const alertIcon = type === 'success' 
                    ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />'
                    : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />';
                
                const alertHTML = `
                    <div class="bg-${alertColor}-100 border-l-4 border-${alertColor}-500 text-${alertColor}-700 p-4 mb-6 rounded-md shadow-sm flex items-center justify-between" role="alert" id="${alertId}">
                        <div class="flex items-center">
                            <svg class="h-6 w-6 text-${alertColor}-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                ${alertIcon}
                            </svg>
                            <p>${message}</p>
                        </div>
                        <button type="button" class="text-${alertColor}-500 hover:text-${alertColor}-700" onclick="document.getElementById('${alertId}').style.display='none'">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                `;
                
                alertContainer.insertAdjacentHTML('afterbegin', alertHTML);
                
                // Auto-hide after 5 seconds
                setTimeout(function() {
                    const alert = document.getElementById(alertId);
                    if (alert) {
                        alert.style.display = 'none';
                    }
                }, 5000);
            }
        </script>
    </div>
</div>
@endsection

