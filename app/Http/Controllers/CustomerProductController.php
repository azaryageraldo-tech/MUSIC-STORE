<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CustomerProductController extends Controller
{
    /**
     * Menampilkan halaman katalog produk khusus untuk pelanggan yang sudah login
     */
    public function index(Request $request)
    {
        // Ambil semua kategori untuk filter
        $categories = Category::all();
        
        // Query dasar
        $query = Product::query()->with('category');
        
        // Filter berdasarkan kategori jika ada
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }
        
        // Pencarian berdasarkan nama produk jika ada
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        // Ambil produk dengan pagination
        $products = $query->where('stock', '>', 0)->latest()->paginate(12);
        
        return view('customer.products.index', compact('products', 'categories'));
    }
    
    /**
     * Menampilkan halaman detail produk khusus untuk pelanggan yang sudah login
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        
        // Ambil produk terkait dari kategori yang sama
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();
            
        return view('customer.products.show', compact('product', 'relatedProducts'));
    }
}