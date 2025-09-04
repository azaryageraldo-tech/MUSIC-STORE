<?php

use App\Http\Controllers\CustomerProductController;

    use App\Http\Controllers\Admin\CategoryController;
    use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
    use App\Http\Controllers\Admin\OrderController;
    use App\Http\Controllers\Admin\ProductController;
    use App\Http\Controllers\Admin\ReportController; // Tambahkan ini
    use App\Http\Controllers\Admin\SettingController;
    use App\Http\Controllers\ProfileController;
    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/', function () {
        // Ambil data kategori
        $categories = App\Models\Category::all();
        
        // Ambil produk terlaris (misalnya 8 produk dengan stok > 0)
        $featuredProducts = App\Models\Product::where('stock', '>', 0)
            ->with('category')
            ->take(8)
            ->get();
        
        return view('public.home', compact('categories', 'featuredProducts'));
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    // Grup Rute untuk Panel Admin
    Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);

        // Rute untuk Pesanan
        Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::put('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

        // Rute untuk Laporan
        Route::get('reports', [ReportController::class, 'index'])->name('reports.index');

        // Rute untuk Pengaturan
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    });


    // Tambahkan rute ini di dalam grup middleware auth
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        
        // Rute untuk katalog produk panel pelanggan
        Route::get('/customer/products', [CustomerProductController::class, 'index'])->name('customer.products.index');
        Route::get('/customer/products/{slug}', [CustomerProductController::class, 'show'])->name('customer.products.show');
    });

    require __DIR__ . '/auth.php';

    // Route untuk katalog produk publik
    Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{slug}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
    

