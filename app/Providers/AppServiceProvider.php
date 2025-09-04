<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use App\Models\StoreSetting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::loginView(function () {
            return view('auth.login');
        });

        Fortify::redirects('login', function (Request $request) {
            $user = Auth::user();
            if ($user && $user->role === 'admin') {
                return route('admin.dashboard');
            }

            return route('dashboard');
        });
        
        // Berbagi data store_settings ke semua view
        View::composer('*', function ($view) {
            $store_settings = StoreSetting::first();
            $view->with('store_settings', $store_settings);
        });
    }
}

