<!-- Produk Terlaris Section -->
<section id="produk" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Produk Terlaris</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Produk-produk favorit yang paling banyak dibeli oleh pelanggan kami.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($featuredProducts as $product)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                <div class="relative">
                    <div class="h-64 w-full overflow-hidden">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/300x300?text=' . $product->name }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    </div>
                    <div class="absolute top-4 right-4 bg-indigo-600 text-white text-xs font-bold px-3 py-1 rounded-full">Terlaris</div>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-indigo-600">{{ $product->category->name }}</span>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <span class="text-sm text-gray-600 ml-1">4.8</span>
                        </div>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                    <p class="text-gray-600 mb-4 line-clamp-2">{{ $product->description }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-xl font-bold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        <a href="#" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-150 ease-in-out">
                            <i class="fas fa-shopping-cart mr-2"></i> Beli
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>