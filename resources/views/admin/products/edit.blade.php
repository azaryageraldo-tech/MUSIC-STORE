@extends('layouts.admin')

@section('header')
    <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
        Edit Produk: {{ $product->name }}
    </h2>
@endsection

@section('content')
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('admin.products._form', ['product' => $product])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

