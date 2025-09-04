<!-- Footer -->
<footer class="bg-gray-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center mb-4">
                    <svg class="h-8 w-8 text-indigo-400" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"/>
                        <path d="M9 19c-4.274 0 -7.164 -2.548 -7.26 -7.501a5.13 5.13 0 0 1 5.26 -5.022c2.09 .255 3.896 1.636 4.9 3.481c1.004 -1.845 2.81 -3.226 4.9 -3.481a5.13 5.13 0 0 1 5.26 5.022c-.096 4.953 -2.986 7.501 -7.26 7.501c-2.269 0 -4.21 -1.02 -5.5 -2.5c-1.29 1.48 -3.231 2.5 -5.5 2.5z" />
                    </svg>
                    <span class="text-xl font-bold ml-2">{{ $store_settings->store_name ?? 'Toko Musik' }}</span>
                </div>
                <p class="text-gray-400 mb-4">Toko alat musik terlengkap dengan kualitas terbaik dan harga terjangkau.</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition duration-150 ease-in-out">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-150 ease-in-out">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-150 ease-in-out">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-150 ease-in-out">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Kategori</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-150 ease-in-out">Gitar</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-150 ease-in-out">Piano & Keyboard</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-150 ease-in-out">Drum & Perkusi</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-150 ease-in-out">Audio & Recording</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-150 ease-in-out">Aksesoris</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Informasi</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-150 ease-in-out">Tentang Kami</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-150 ease-in-out">Cara Pembelian</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-150 ease-in-out">Pengiriman</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-150 ease-in-out">FAQ</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-150 ease-in-out">Kontak</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                <ul class="space-y-2">
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt mt-1 mr-3 text-indigo-400"></i>
                        <span class="text-gray-400">{{ $store_settings->store_address ?? 'Jl. Musik Raya No. 123, Jakarta Selatan, DKI Jakarta 12345' }}</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-phone-alt mt-1 mr-3 text-indigo-400"></i>
                        <span class="text-gray-400">(021) 1234-5678</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-envelope mt-1 mr-3 text-indigo-400"></i>
                        <span class="text-gray-400">info@tokomusik.com</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-university mt-1 mr-3 text-indigo-400"></i>
                        <span class="text-gray-400">{{ $store_settings->bank_details ?? 'Bank BCA - 1234567890 a.n. Toko Musik' }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
            <p>&copy; {{ date('Y') }} {{ $store_settings->store_name ?? 'Toko Musik' }}. All rights reserved.</p>
        </div>
    </div>
</footer>