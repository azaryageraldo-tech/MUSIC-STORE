<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-100">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-indigo-50 to-purple-50">
            <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-xl overflow-hidden sm:rounded-xl">
                <div class="mb-6 flex justify-center">
                    <a href="/" class="flex items-center">
                        <svg class="h-12 w-12 text-indigo-600" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z"/>
                            <path d="M9 19c-4.274 0 -7.164 -2.548 -7.26 -7.501a5.13 5.13 0 0 1 5.26 -5.022c2.09 .255 3.896 1.636 4.9 3.481c1.004 -1.845 2.81 -3.226 4.9 -3.481a5.13 5.13 0 0 1 5.26 5.022c-.096 4.953 -2.986 7.501 -7.26 7.501c-2.269 0 -4.21 -1.02 -5.5 -2.5c-1.29 1.48 -3.231 2.5 -5.5 2.5z" />
                        </svg>
                        <span class="text-2xl font-bold text-gray-900 ml-2">Toko Musik</span>
                    </a>
                </div>
                
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} Toko Musik. Semua hak dilindungi.
            </div>
        </div>
    </body>
</html>
