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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
                Tambah Produk Baru
            </h2>
        </div>
    </div>
@endsection

@section('content')
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('admin.products._form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

