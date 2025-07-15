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
            <!-- Main header -->
            <div class="flex items-center justify-between py-4">
                <div class="flex items-center space-x-8">
                    <a href="/" class="flex items-center space-x-2">
                        <img src="{{ asset('images/cam.jpg') }}" alt="URPOCKETDIGICAM Logo" class="w-12 h-10">
                        <span class="text-2xl font-bold text-gray-900">URPOCKETDIGICAM</span>
                    </a>
                    <nav class="hidden lg:flex items-center space-x-8">
                        <a href="#" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">Products</a>
                        <a href="#"
                            class="text-gray-700 hover:text-blue-600 font-medium transition-colors">Categories</a>
                    </nav>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="hidden md:flex items-center space-x-2 bg-gray-100 rounded-lg px-3 py-2">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" placeholder="Search cameras, lenses..."
                            class="border-0 bg-transparent focus:outline-none w-64 text-sm">
                    </div>
                    <a href="/login" class="p-2 text-gray-600 hover:text-blue-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </a>
                    <a href="/login" class="p-2 text-gray-600 hover:text-blue-600 transition-colors relative">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17M17 13a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span
                            class="absolute -top-2 -right-2 bg-blue-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">0</span>
                    </a>
                    <button class="lg:hidden p-2 text-gray-600 hover:text-blue-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative h-screen bg-gradient-to-r from-gray-900 to-gray-700 overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ asset('images/.jpg') }}" alt="Professional camera setup"
                class="w-full h-full object-cover opacity-30">
        </div>
        <div class="relative container mx-auto px-4 h-full flex items-center">
            <div class="max-w-2xl text-white">
                <span class="inline-block bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-medium mb-4">New
                    Arrivals</span>
                <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                    Capture Every
                    <span class="block text-blue-400">Moment</span>
                </h1>
                <p class="text-xl mb-8 text-gray-300 leading-relaxed">
                    Professional cameras and lenses for photographers who demand excellence. Discover our latest
                    collection of cutting-edge equipment.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#"
                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-lg font-semibold text-center transition-colors">
                        Shop Cameras
                    </a>
                    <a href="#"
                        class="inline-block border-2 border-white text-white hover:bg-white hover:text-black px-8 py-4 rounded-lg font-semibold text-center transition-colors">
                        View Deals
                    </a>
                </div>
            </div>
        </div>

        <!-- Promotional banner -->
        <div class="absolute bottom-0 left-0 w-full bg-blue-600 py-3 overflow-hidden">
            <div class="flex animate-marquee whitespace-nowrap">
                <span class="mx-8 text-white font-medium">🎯 Up to 40% off selected cameras</span>
                <span class="mx-8 text-white font-medium">📦 Free shipping on orders over $500</span>
                <span class="mx-8 text-white font-medium">🔄 30-day return policy</span>
                <span class="mx-8 text-white font-medium">🎯 Up to 40% off selected cameras</span>
                <span class="mx-8 text-white font-medium">📦 Free shipping on orders over $500</span>
                <span class="mx-8 text-white font-medium">🔄 30-day return policy</span>
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
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Featured Products</h2>
                <a href="#"
                    class="border border-gray-300 hover:border-blue-600 hover:text-blue-600 px-6 py-2 rounded-lg font-medium transition-colors">
                    View All Products
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $products = [
                        ['name' => 'Canon EOS R5', 'price' => '$3,899', 'rating' => '4.9', 'image' => 'canon-r5.jpg'],
                        ['name' => 'Sony A7 IV', 'price' => '$2,499', 'rating' => '4.8', 'image' => 'sony-a7iv.jpg'],
                        ['name' => 'Nikon Z9', 'price' => '$5,499', 'rating' => '4.9', 'image' => 'nikon-z9.jpg'],
                        ['name' => 'Fujifilm X-T5', 'price' => '$1,699', 'rating' => '4.7', 'image' => 'fuji-xt5.jpg']
                    ];
                @endphp

                @foreach($products as $product)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow group cursor-pointer">
                        <div class="aspect-square bg-gray-100 relative overflow-hidden rounded-t-lg">
                            <img src="{{ asset('images/products/' . $product['image']) }}" alt="{{ $product['name'] }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300 p-4">
                            <span
                                class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded text-sm font-medium">Sale</span>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold mb-2 text-gray-900">{{ $product['name'] }}</h3>
                            <div class="flex items-center mb-2">
                                <div class="flex items-center">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>
                                <span class="text-sm text-gray-600 ml-2">({{ $product['rating'] }})</span>
                            </div>
                            <p class="text-xl font-bold text-blue-600">{{ $product['price'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Brand Showcase -->
    <section class="py-16 bg-gray-50">
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
    <section class="py-16 bg-blue-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Stay Updated</h2>
            <p class="text-xl mb-8 opacity-90">Get the latest camera news, deals, and photography tips</p>
            <form action="#" method="POST" class="max-w-md mx-auto flex gap-4">
                @csrf
                <input type="email" name="email" placeholder="Enter your email" required
                    class="flex-1 px-4 py-3 rounded-lg text-black focus:outline-none focus:ring-2 focus:ring-white">
                <button type="submit"
                    class="bg-white text-blue-600 hover:bg-gray-100 px-6 py-3 rounded-lg font-semibold transition-colors">
                    Subscribe
                </button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="text-xl font-bold">URPOCKETDIGICAM</span>
                    </div>
                    <p class="text-gray-400 mb-4">
                        Your trusted partner for professional photography equipment since 2010.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Instagram</a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Facebook</a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">YouTube</a>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Products</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">DSLR Cameras</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Mirrorless Cameras</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Lenses</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Accessories</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Support</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Shipping Info</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Returns</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Warranty</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Company</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Careers</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Press</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} URPOCKETDIGICAM. All rights reserved. | Powered by <a
                        href="https://laravel.com" class="hover:text-white transition-colors">Laravel</a></p>
            </div>
        </div>
    </footer>

    <style>
        @keyframes marquee {
            0% {
                transform: translateX(0%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .animate-marquee {
            animation: marquee 25s linear infinite;
        }
    </style>

</body>

</html>