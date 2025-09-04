<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin Panel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="font-sans antialiased bg-gray-50">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">
        <!-- Sidebar Overlay -->
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 bg-black bg-opacity-50 transition-opacity lg:hidden"></div>

        <!-- Sidebar -->
        <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gradient-to-br from-indigo-800 to-indigo-900 lg:translate-x-0 lg:static lg:inset-0 scrollbar-thin scrollbar-thumb-indigo-700 scrollbar-track-indigo-800">
            <!-- Logo -->
            <div class="flex items-center justify-center p-6 border-b border-indigo-700">
                <div class="flex items-center">
                    <svg class="h-10 w-10 text-indigo-300" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"/>
                        <path d="M9 19c-4.274 0 -7.164 -2.548 -7.26 -7.501a5.13 5.13 0 0 1 5.26 -5.022c2.09 .255 3.896 1.636 4.9 3.481c1.004 -1.845 2.81 -3.226 4.9 -3.481a5.13 5.13 0 0 1 5.26 5.022c-.096 4.953 -2.986 7.501 -7.26 7.501c-2.269 0 -4.21 -1.02 -5.5 -2.5c-1.29 1.48 -3.231 2.5 -5.5 2.5z" />
                    </svg>
                    <span class="text-white text-2xl mx-2 font-bold">Toko Musik</span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="mt-6 px-4 space-y-2">
                <a class="flex items-center py-3 px-4 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-700 hover:text-white' }}" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt w-5 h-5"></i>
                    <span class="mx-3 font-medium">Dashboard</span>
                </a>

                <a class="flex items-center py-3 px-4 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.orders.*') ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-700 hover:text-white' }}" href="{{ route('admin.orders.index') }}">
                    <i class="fas fa-shopping-cart w-5 h-5"></i>
                    <span class="mx-3 font-medium">Pesanan</span>
                </a>

                <a class="flex items-center py-3 px-4 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.reports.*') ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-700 hover:text-white' }}" href="{{ route('admin.reports.index') }}">
                    <i class="fas fa-chart-bar w-5 h-5"></i>
                    <span class="mx-3 font-medium">Laporan</span>
                </a>

                <div class="pt-4 pb-2">
                    <span class="px-4 text-xs font-semibold text-indigo-300 uppercase tracking-wider">Manajemen Toko</span>
                </div>

                <a class="flex items-center py-3 px-4 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.categories.*') ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-700 hover:text-white' }}" href="{{ route('admin.categories.index') }}">
                    <i class="fas fa-folder w-5 h-5"></i>
                    <span class="mx-3 font-medium">Kategori</span>
                </a>

                <a class="flex items-center py-3 px-4 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.products.*') ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-700 hover:text-white' }}" href="{{ route('admin.products.index') }}">
                    <i class="fas fa-guitar w-5 h-5"></i>
                    <span class="mx-3 font-medium">Produk</span>
                </a>

                <a class="flex items-center py-3 px-4 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.settings.*') ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-700 hover:text-white' }}" href="{{ route('admin.settings.index') }}">
                    <i class="fas fa-cog w-5 h-5"></i>
                    <span class="mx-3 font-medium">Pengaturan</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header -->
            <header class="flex justify-between items-center py-4 px-6 bg-white shadow-sm">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <div class="ml-4 lg:ml-0">
                        <h2 class="text-2xl font-semibold text-gray-800">@yield('header', 'Dashboard')</h2>
                    </div>
                </div>
                
                <!-- User Dropdown -->
                <div class="relative">
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-indigo-600 flex items-center justify-center text-white mr-2">
                                            {{ substr(Auth::user()->name, 0, 1) }}
                                        </div>
                                        <div>{{ Auth::user()->name }}</div>
                                    </div>
                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    <i class="fas fa-user-circle mr-2"></i> {{ __('Profile') }}
                                </x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                        <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
                <!-- Alert Messages -->
                @if (session('success'))
                    <x-alert type="success" dismissible="true" class="mb-6">
                        {{ session('success') }}
                    </x-alert>
                @endif

                @if (session('error'))
                    <x-alert type="error" dismissible="true" class="mb-6">
                        {{ session('error') }}
                    </x-alert>
                @endif

                @if (session('warning'))
                    <x-alert type="warning" dismissible="true" class="mb-6">
                        {{ session('warning') }}
                    </x-alert>
                @endif

                @if (session('info'))
                    <x-alert type="info" dismissible="true" class="mb-6">
                        {{ session('info') }}
                    </x-alert>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>

