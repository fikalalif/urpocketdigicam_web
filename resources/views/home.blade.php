<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>URPOCKETDIGICAM - Professional Camera Equipment</title>
    <meta name="description"
        content="Professional cameras, lenses, and photography equipment. Your trusted partner for capturing perfect moments.">

    @vite('resources/css/app.css')
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-white font-sans antialiased">

    <!-- Header -->
    <header class="border-b bg-white sticky top-0 z-50 shadow-sm">
        <div class="container mx-auto px-4">
            <!-- Header utama -->
            <div class="flex items-center justify-between py-4">
                <!-- Kiri: Logo & Navigasi -->
                <div class="flex items-center space-x-8">
                    <a href="/" class="flex items-center space-x-2">
                        <img src="{{ asset('images/cam.jpg') }}" alt="URPOCKETDIGICAM Logo" class="w-12 h-10">
                        <span class="text-2xl font-extrabold tracking-widest text-gray-900">
                            <span class="text-[#4f46e5]">URPOCKET</span><span class="text-[#ec4899]">DIGICAM</span>
                        </span>

                    </a>
                    <nav class="hidden lg:flex items-center space-x-8">
                        <a href="#products" class="text-gray-700 hover:text-[#4f46e5] font-medium transition-colors">
                            Products
                        </a>
                        <a href="#categories" class="text-gray-700 hover:text-[#4f46e5] font-medium transition-colors">
                            Categories
                        </a>
                    </nav>
                </div>

                <!-- Kanan: Search + Auth -->
                <div class="flex items-center space-x-4">
                    <!-- Search -->
                    <div class="hidden md:flex items-center bg-gray-100 rounded-md px-3 py-2 w-72">
                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text"
                            placeholder="Search cameras, lenses..."
                            class="w-full bg-transparent border-0 focus:outline-none text-sm text-gray-700 placeholder-gray-400">
                    </div>

                    <!-- Login -->
                    <a href="{{ route('login') }}"
                        class="hidden md:inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-[#4f46e5] hover:text-white border border-gray-300 rounded-md transition-colors">
                        Login
                    </a>

                    <!-- Register -->
                    <a href="{{ route('register') }}"
                        class="hidden md:inline-block px-4 py-2 text-sm font-medium text-white bg-[#4f46e5] hover:bg-[#3730a3] rounded-md transition-colors">
                        Daftar
                    </a>

                    <!-- Mobile Menu (ikon burger) -->
                    <button class="lg:hidden p-2 text-gray-600 hover:text-[#4f46e5] transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

    </header>
    <!-- Hero Section -->
    <section class="relative h-screen bg-gradient-to-r from-gray-900 to-gray-800 flex items-center">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl text-white">
                <span class="inline-block bg-[#4f46e5] text-white px-3 py-1 rounded-full text-sm font-semibold mb-4 uppercase tracking-wide">
                    New in Stock
                </span>
                <h1 class="text-5xl md:text-6xl font-extrabold mb-6 leading-tight text-white">
                    Discover Elite <span class="block text-[#db2777]">Digital Gear</span>
                </h1>
                <p class="text-lg md:text-xl mb-8 text-gray-300 leading-relaxed">
                    Explore our curated selection of cameras and lenses for professionals and enthusiasts. Pure quality, no distractions.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#"
                        class="inline-block bg-[#db2777] hover:bg-[#be185d] text-white px-6 py-3 rounded-md font-medium transition-colors">
                        Browse Catalog
                    </a>
                    <a href="#"
                        class="inline-block border border-white text-white hover:bg-white hover:text-black px-6 py-3 rounded-md font-medium transition-colors">
                        View Offers
                    </a>
                </div>
            </div>
        </div>

        <!-- Promotional banner -->
        <!-- Promotional banner -->
        <div class="absolute bottom-0 left-0 w-full bg-[#4f46e5] py-2 overflow-hidden">
            <div class="animate-marquee whitespace-nowrap text-sm md:text-base font-medium text-white tracking-wide">
                <span class="inline-block px-8">Explore 100+ Camera Models</span>
                <span class="inline-block px-8">Fast & Secure Shipping</span>
                <span class="inline-block px-8">Trusted by Professional Photographers</span>
                <span class="inline-block px-8">Explore 100+ Camera Models</span>
                <span class="inline-block px-8">Fast & Secure Shipping</span>
                <span class="inline-block px-8">Trusted by Professional Photographers</span>
                <span class="inline-block px-8">Explore 100+ Camera Models</span>
                <span class="inline-block px-8">Fast & Secure Shipping</span>
                <span class="inline-block px-8">Trusted by Professional Photographers</span>
            </div>
        </div>

    </section>


    <!-- Featured Categories -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4 text-gray-900">Shop by Category</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Find the perfect equipment for your photography needs, from professional DSLRs to compact mirrorless
                    cameras
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow group cursor-pointer">
                    <div class="aspect-[4/3] bg-gray-200 relative overflow-hidden rounded-t-lg">
                        <img src="{{ asset('images/cam1.jpg') }}" alt="Professional camera setup"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>

                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2 text-gray-900">DSLR Cameras</h3>
                        <p class="text-gray-600 mb-4">Professional-grade cameras for serious photographers</p>
                        <a href="#"
                            class="inline-block w-full text-center border border-gray-300 hover:border-blue-600 hover:text-blue-600 px-4 py-2 rounded-lg font-medium transition-colors">
                            Explore DSLRs
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow group cursor-pointer">
                    <div class="aspect-[4/3] bg-gray-200 relative overflow-hidden rounded-t-lg">
                        <img src="{{ asset('images/cam2.jpg') }}" alt="Professional camera setup"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2 text-gray-900">Mirrorless Cameras</h3>
                        <p class="text-gray-600 mb-4">Compact and lightweight with exceptional image quality</p>
                        <a href="#"
                            class="inline-block w-full text-center border border-gray-300 hover:border-blue-600 hover:text-blue-600 px-4 py-2 rounded-lg font-medium transition-colors">
                            Shop Mirrorless
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow group cursor-pointer">
                    <div class="aspect-[4/3] bg-gray-200 relative overflow-hidden rounded-t-lg">
                        <img src="{{ asset('images/cam3.jpg') }}" alt="Professional camera setup"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2 text-gray-900">Premium Lenses</h3>
                        <p class="text-gray-600 mb-4">High-quality lenses for every shooting scenario</p>
                        <a href="#"
                            class="inline-block w-full text-center border border-gray-300 hover:border-blue-600 hover:text-blue-600 px-4 py-2 rounded-lg font-medium transition-colors">
                            Browse Lenses
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-16" id="products">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Featured Products</h2>
                <a href="#"
                    class="border border-gray-300 hover:border-blue-600 hover:text-blue-600 px-6 py-2 rounded-lg font-medium transition-colors">
                    View All Products
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($products as $product)
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow group cursor-pointer">
                    <div class="aspect-square bg-gray-100 relative overflow-hidden rounded-t-lg">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/placeholder.jpg') }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300 p-4">
                        <span
                            class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded text-sm font-medium">Sale</span>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold mb-2 text-gray-900">{{ $product->name }}</h3>
                        <p class="text-xl font-bold text-blue-600">Rp{{ number_format($product->price, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 col-span-full text-center">No products available.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Brand Showcase -->
    <section class="py-16 bg-gray-50" id="categories">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-900">Trusted Brands</h2>
            <div class="grid grid-cols-2 md:grid-cols-6 gap-8 items-center">
                @php
                $brands = ['Canon', 'Sony', 'Nikon', 'Fujifilm', 'Leica', 'Olympus'];
                @endphp
                @foreach($brands as $brand)
                <div class="flex items-center justify-center p-4 bg-white rounded-lg hover:shadow-md transition-shadow">
                    <span class="text-xl font-bold text-gray-600">{{ $brand }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-900">Why Choose URPOCKETDIGICAM</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-900">Free Shipping</h3>
                    <p class="text-gray-600">Free shipping on all orders over $500 worldwide</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-900">2-Year Warranty</h3>
                    <p class="text-gray-600">Comprehensive warranty on all camera equipment</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-900">Expert Support</h3>
                    <p class="text-gray-600">24/7 technical support from photography experts</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-900">Best Price Guarantee</h3>
                    <p class="text-gray-600">We match any competitor's price on identical items</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <!-- Newsletter
<section class="py-16 bg-[#1f2235] text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4 tracking-wide">Stay Updated</h2>
        <p class="text-base md:text-lg mb-8 opacity-80 max-w-xl mx-auto">
            Subscribe to receive the latest camera news, exclusive deals, and photography tips — straight to your inbox.
        </p>
        <form action="#" method="POST" class="max-w-xl mx-auto flex flex-col sm:flex-row gap-4">
            @csrf
            <input type="email" name="email" placeholder="Enter your email" required
                class="flex-1 px-4 py-3 rounded-md text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-[#4f46e5]">
            <button type="submit"
                class="bg-[#4f46e5] hover:bg-[#3f3ac7] text-white px-6 py-3 rounded-md font-semibold transition-colors">
                Subscribe
            </button>
        </form>
    </div>
</section> -->


    <!-- Footer -->
    <footer class="bg-[#111827] text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <div>
                    <div class="mb-4">
                        <a href="/" class="flex items-center space-x-3">
                            <span class="text-2xl font-extrabold tracking-widest">
                                <span class="text-[#4f46e5]">URPOCKET</span><span class="text-[#ec4899]">DIGICAM</span>
                            </span>
                        </a>
                    </div>
                    <p class="text-gray-400 mb-6 text-sm leading-relaxed">
                        Your trusted partner for professional photography equipment since 2010.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Instagram</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Facebook</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">YouTube</a>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Products</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-white transition-colors">DSLR Cameras</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Mirrorless Cameras</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Lenses</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Accessories</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Support</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-white transition-colors">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Shipping Info</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Returns</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Warranty</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Company</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Careers</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Press</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-10 pt-6 text-center text-gray-500 text-sm">
                <p>&copy; {{ date('Y') }} URPOCKETDIGICAM. All rights reserved. | Powered by
                    <a href="https://laravel.com" class="hover:text-white">Laravel</a>
                </p>
            </div>
        </div>
    </footer>


</body>

</html>