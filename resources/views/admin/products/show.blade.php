@extends('layouts.admin')

@section('header')
    <div class="flex items-center">
        <a href="{{ route('admin.products.index') }}" class="mr-4 p-2 bg-white rounded-full shadow-sm hover:bg-gray-100 transition-colors duration-200">
            <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <div class="flex items-center">
            <svg class="h-8 w-8 text-indigo-600 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
            </svg>
            <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
                Detail Produk
            </h2>
        </div>
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
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Kolom Gambar -->
                    <div class="md:col-span-1">
                        <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-auto rounded-lg object-cover shadow-md hover:shadow-lg transition-shadow duration-300">
                            @else
                                <div class="w-full h-64 bg-gray-200 flex items-center justify-center rounded-lg border border-gray-300">
                                    <svg class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                            
                            <div class="mt-4 flex justify-between items-center">
                                <div>
                                    <span class="text-sm font-medium text-gray-500">Status Stok:</span>
                                    @if($product->stock > 10)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 ml-2">
                                            Tersedia
                                        </span>
                                    @elseif($product->stock > 0)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 ml-2">
                                            Terbatas
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 ml-2">
                                            Habis
                                        </span>
                                    @endif
                                </div>
                                <span class="text-sm text-gray-500">ID: #{{ $product->id }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Detail -->
                    <div class="md:col-span-2 space-y-6">
                        <div class="flex justify-between items-start">
                            <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.products.edit', $product) }}" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg class="-ml-0.5 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        <svg class="-ml-0.5 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <span class="text-sm font-medium text-gray-500">Kategori:</span>
                                    <div class="flex items-center mt-1">
                                        <svg class="h-5 w-5 text-indigo-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                        <p class="text-lg text-indigo-600 font-semibold">{{ $product->category->name }}</p>
                                    </div>
                                </div>
                                
                                <div>
                                    <span class="text-sm font-medium text-gray-500">Harga:</span>
                                    <div class="flex items-center mt-1">
                                        <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="text-2xl text-gray-800 font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                
                                <div>
                                    <span class="text-sm font-medium text-gray-500">Stok Tersisa:</span>
                                    <div class="flex items-center mt-1">
                                        <svg class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                        <p class="text-lg text-gray-700">{{ $product->stock }} buah</p>
                                    </div>
                                </div>
                                
                                <div>
                                    <span class="text-sm font-medium text-gray-500">Terakhir Diperbarui:</span>
                                    <div class="flex items-center mt-1">
                                        <svg class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="text-sm text-gray-600">{{ $product->updated_at->format('d M Y, H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <span class="text-sm font-medium text-gray-500 flex items-center">
                                <svg class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                                </svg>
                                Deskripsi:
                            </span>
                            <div class="mt-2 bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                <div class="text-gray-600 prose max-w-none">
                                    {!! nl2br(e($product->description)) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Kembali -->
                <div class="mt-8 pt-6 border-t border-gray-200 flex justify-between items-center">
                    <div class="text-sm text-gray-500">
                        <span>Dibuat: {{ $product->created_at->format('d M Y') }}</span>
                    </div>
                    <a href="{{ route('admin.products.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Daftar Produk
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script untuk Alert --}}
<script>
    // Auto-hide alert after 5 seconds
    setTimeout(function() {
        const successAlert = document.getElementById('success-alert');
        if (successAlert) {
            successAlert.style.display = 'none';
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
@endsection
