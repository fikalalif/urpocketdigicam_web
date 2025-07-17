<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>URPOCKETDIGICAM - Your Pocket's Best Digital Camera Collection</title>
    <meta name="description"
        content="Discover premium digital cameras, lenses, and photography equipment. From pocket cameras to professional DSLRs - find your perfect shot with trusted brands.">
    <meta name="keywords"
        content="digital camera, photography equipment, Canon, Sony, Nikon, Fujifilm, camera store, professional photography, pocket camera, mirrorless camera, DSLR">
    <meta name="author" content="URPOCKETDIGICAM">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="URPOCKETDIGICAM - Your Pocket's Best Digital Camera Collection">
    <meta property="og:description"
        content="Discover premium digital cameras and photography equipment from trusted brands.">
    <meta property="og:image" content="{{ asset('images/products/cam1.jpg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* ===== CUSTOM PIXEL AESTHETIC STYLES ===== */
        :root {
            --primary-pink: #ec4899;
            --primary-cyan: #7dd3fc;
            --dark-pink: #be185d;
            --dark-cyan: #0284c7;
            --pixel-black: #000000;
            --pixel-shadow: rgba(0, 0, 0, 0.3);
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            font-size: 16px;
        }

        body {
            font-family: 'Inter', 'Segoe UI', -apple-system, BlinkMacSystemFont, sans-serif;
            line-height: 1.6;
            color: #1f2937;
            background-color: #ffffff;
            overflow-x: hidden;
        }

        /* ===== PIXEL DESIGN SYSTEM ===== */
        .pixel-border {
            border: 2px solid var(--pixel-black);
            box-shadow: 4px 4px 0px var(--pixel-black);
        }

        .pixel-border-light {
            border: 1px solid var(--pixel-black);
            box-shadow: 2px 2px 0px var(--pixel-black);
        }

        .pixel-shadow {
            box-shadow: 4px 4px 0px var(--pixel-shadow);
        }

        .pixel-shadow-lg {
            box-shadow: 6px 6px 0px var(--pixel-shadow);
        }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        .animate-slide-in-right {
            animation: slideInRight 0.5s ease-out;
        }

        .animate-pulse-slow {
            animation: pulse 3s infinite;
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        /* ===== HOVER EFFECTS ===== */
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .hover-scale {
            transition: transform 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }

        .hover-glow {
            transition: all 0.3s ease;
        }

        .hover-glow:hover {
            box-shadow: 0 0 20px rgba(236, 72, 153, 0.4);
        }

        /* ===== GRADIENT BACKGROUNDS ===== */
        .gradient-primary {
            background: linear-gradient(135deg, var(--primary-cyan) 0%, var(--primary-pink) 100%);
        }

        .gradient-secondary {
            background: linear-gradient(135deg, #f0f9ff 0%, #fef7ff 100%);
        }

        .gradient-dark {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
        }

        /* ===== CUSTOM SCROLLBAR ===== */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-pink);
            border-radius: 4px;
            border: 1px solid var(--pixel-black);
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--dark-pink);
        }

        /* ===== RESPONSIVE DESIGN ===== */
        @media (max-width: 640px) {
            .pixel-border {
                border-width: 1px;
                box-shadow: 2px 2px 0px var(--pixel-black);
            }

            .pixel-shadow {
                box-shadow: 2px 2px 0px var(--pixel-shadow);
            }

            html {
                font-size: 14px;
            }
        }

        /* ===== COMPONENT SPECIFIC STYLES ===== */
        .navbar-scrolled {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .product-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            transition: transform 0.5s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.1);
        }

        .category-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s;
        }

        .category-card:hover::before {
            left: 100%;
        }

        .contact-input {
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 12px 16px;
            transition: all 0.3s ease;
            background: white;
        }

        .contact-input:focus {
            border-color: var(--primary-pink);
            box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.1);
        }

        /* ===== UTILITY CLASSES ===== */
        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .aspect-square {
            aspect-ratio: 1 / 1;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-clamp: 2;
            /* Standard property for compatibility */
        }

        /* ===== LOADING STATES ===== */
        .loading {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        /* ===== FOCUS STYLES ===== */
        button:focus,
        a:focus,
        input:focus,
        textarea:focus {
            outline: 2px solid var(--primary-pink);
            outline-offset: 2px;
        }
    </style>
</head>

<body class="bg-white font-sans antialiased" x-data="{
          isMenuOpen: false,
          scrollY: 0,
          init() {
              window.addEventListener('scroll', () => {
                  this.scrollY = window.pageYOffset;
              });
              window.addEventListener('resize', () => {
                  if (window.innerWidth >= 768) {
                      this.isMenuOpen = false;
                  }
              });
              document.addEventListener('keydown', (e) => {
                  if (e.key === 'Escape' && this.isMenuOpen) {
                      this.isMenuOpen = false;
                  }
              });
          },
          scrollToSection(sectionId) {
              const element = document.getElementById(sectionId);
              if (element) {
                  const offset = 80;
                  const elementPosition = element.getBoundingClientRect().top;
                  const offsetPosition = elementPosition + window.pageYOffset - offset;
                  window.scrollTo({
                      top: offsetPosition,
                      behavior: 'smooth'
                  });
              }
              this.isMenuOpen = false;
          }
      }">
    <!-- ===== NAVIGATION BAR ===== -->
    <nav class="fixed top-0 w-full z-50 transition-all duration-300"
        :class="scrollY > 50 ? 'navbar-scrolled pixel-border-light' : 'bg-white'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-0 animate-fade-in-up">
                    <img src="{{ asset('images/cam.jpg') }}" class="w-11 h-10 " alt="logo">
                    <a href="/" class="text-xl font-bold text-gray-900 hover:opacity-80 transition-opacity">
                        <span class="text-cyan-500">URPOCKET</span><span class="text-pink-600">DIGICAM</span>
                    </a>
                </div>
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <button @click="scrollToSection('home')"
                        class="text-gray-700 hover:text-pink-600 font-medium transition-colors relative group">
                        Home
                        <span
                            class="absolute -bottom-1 left-0 w-0 h-0.5 bg-pink-600 transition-all group-hover:w-full"></span>
                    </button>
                    <button @click="scrollToSection('introduction')"
                        class="text-gray-700 hover:text-pink-600 font-medium transition-colors relative group">
                        About
                        <span
                            class="absolute -bottom-1 left-0 w-0 h-0.5 bg-pink-600 transition-all group-hover:w-full"></span>
                    </button>
                    <button @click="scrollToSection('featured-products')"
                        class="text-gray-700 hover:text-pink-600 font-medium transition-colors relative group">
                        Products
                        <span
                            class="absolute -bottom-1 left-0 w-0 h-0.5 bg-pink-600 transition-all group-hover:w-full"></span>
                    </button>
                    <button @click="scrollToSection('product-categories')"
                        class="text-gray-700 hover:text-pink-600 font-medium transition-colors relative group">
                        Categories
                        <span
                            class="absolute -bottom-1 left-0 w-0 h-0.5 bg-pink-600 transition-all group-hover:w-full"></span>
                    </button>
                    <button @click="scrollToSection('brands')"
                        class="text-gray-700 hover:text-pink-600 font-medium transition-colors relative group">
                        Brands
                        <span
                            class="absolute -bottom-1 left-0 w-0 h-0.5 bg-pink-600 transition-all group-hover:w-full"></span>
                    </button>
                    <button @click="scrollToSection('contact')"
                        class="text-gray-700 hover:text-pink-600 font-medium transition-colors relative group">
                        Contact
                        <span
                            class="absolute -bottom-1 left-0 w-0 h-0.5 bg-pink-600 transition-all group-hover:w-full"></span>
                    </button>
                </div>
                <!-- Special Buttons -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="https://phb-umkm.my.id/"
                        class="inline-flex items-center px-4 py-2 border-2 border-cyan-300 text-cyan-600 hover:bg-cyan-50 bg-transparent rounded-lg font-medium transition-all hover-lift pixel-border-light">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        Visit UMKM
                    </a>
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center px-4 py-2 bg-pink-600 hover:bg-pink-700 text-white rounded-lg font-medium transition-all hover-lift pixel-shadow">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                        Admin
                    </a>
                </div>
                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button @click="isMenuOpen = !isMenuOpen"
                        class="p-2 text-gray-600 hover:text-pink-600 transition-colors hover-scale">
                        <svg x-show="!isMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg x-show="isMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile Navigation -->
        <div x-show="isMenuOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-2"
            class="md:hidden bg-white border-t pixel-border-light">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <button @click="scrollToSection('home')"
                    class="block w-full text-left px-3 py-2 text-gray-700 hover:text-pink-600 hover:bg-pink-50 font-medium rounded-lg transition-colors">Home</button>
                <button @click="scrollToSection('introduction')"
                    class="block w-full text-left px-3 py-2 text-gray-700 hover:text-pink-600 hover:bg-pink-50 font-medium rounded-lg transition-colors">About</button>
                <button @click="scrollToSection('featured-products')"
                    class="block w-full text-left px-3 py-2 text-gray-700 hover:text-pink-600 hover:bg-pink-50 font-medium rounded-lg transition-colors">Products</button>
                <button @click="scrollToSection('product-categories')"
                    class="block w-full text-left px-3 py-2 text-gray-700 hover:text-pink-600 hover:bg-pink-50 font-medium rounded-lg transition-colors">Categories</button>
                <button @click="scrollToSection('brands')"
                    class="block w-full text-left px-3 py-2 text-gray-700 hover:text-pink-600 hover:bg-pink-50 font-medium rounded-lg transition-colors">Brands</button>
                <button @click="scrollToSection('contact')"
                    class="block w-full text-left px-3 py-2 text-gray-700 hover:text-pink-600 hover:bg-pink-50 font-medium rounded-lg transition-colors">Contact</button>
                <div class="px-3 py-2 space-y-2">
                    <a href="#"
                        class="block w-full text-center px-4 py-2 border-2 border-cyan-300 text-cyan-600 hover:bg-cyan-50 bg-transparent rounded-lg font-medium transition-colors">
                        Visit UMKM
                    </a>
                    <a href="{{ route('dashboard') }}"
                        class="block w-full text-center px-4 py-2 bg-pink-600 hover:bg-pink-700 text-white rounded-lg font-medium transition-colors">
                        Admin
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- ===== HERO SECTION ===== -->
    <section id="home" class="pt-16 min-h-screen gradient-secondary flex items-center relative overflow-hidden">
        <!-- Background Decorations - Adjusted positions to avoid overlap with main content -->
        <div
            class="absolute top-20 left-4 w-20 h-20 bg-pink-200 rounded-full pixel-border animate-float opacity-60 md:left-10">
        </div>
        <div class="absolute bottom-20 right-4 w-16 h-16 bg-cyan-200 rounded-lg pixel-border animate-float opacity-60 md:right-10"
            style="animation-delay: 1s;"></div>
        {{-- <div
            class="absolute top-1/2 left-1/4 w-12 h-12 bg-pink-300 rounded-full pixel-border animate-pulse-slow opacity-40">
        </div> --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="animate-fade-in-up">
                    <div
                        class="inline-block bg-gradient-to-r from-pink-500 to-cyan-500 text-white px-4 py-2 rounded-full text-sm font-semibold mb-6 pixel-shadow animate-pulse-slow">
                        ✨ Premium Camera Collection
                    </div>
                    <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight text-shadow">
                        Your Pocket's Best
                        <span class="text-pink-600 relative">
                            Digital Camera
                            <svg class="absolute -bottom-2 left-0 w-full h-3 text-pink-200" viewBox="0 0 100 10"
                                preserveAspectRatio="none">
                                <path d="M0,8 Q50,0 100,8" stroke="currentColor" stroke-width="2" fill="none" />
                            </svg>
                        </span>
                        Collection
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        Explore high-quality cameras from trusted brands. Professional equipment for every
                        photographer's journey,
                        from pocket-sized companions to professional-grade DSLRs.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button @click="scrollToSection('featured-products')"
                            class="inline-flex items-center bg-pink-600 hover:bg-pink-700 text-white px-8 py-4 text-lg rounded-lg pixel-shadow font-medium transition-all hover-lift">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                            Explore Now
                        </button>
                        <button @click="scrollToSection('introduction')"
                            class="inline-flex items-center border-2 border-gray-300 text-gray-700 hover:border-pink-600 hover:text-pink-600 px-8 py-4 text-lg rounded-lg font-medium transition-all hover-lift pixel-border-light">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Learn More
                        </button>
                    </div>
                </div>
                <div class="relative animate-slide-in-right" x-data="{
         images: [
             '{{ asset('images/cam1.jpg') }}',
             '{{ asset('images/cam2.jpg') }}',
             '{{ asset('images/cam3.jpg') }}'
         ],
         current: 0,
         get currentImage() {
             return this.images[this.current];
         },
         startRotation() {
             setInterval(() => {
                 this.current = (this.current + 1) % this.images.length;
             }, 3000);
         }
     }" x-init="startRotation()">
                    <div
                        class="w-full h-96 gradient-primary rounded-2xl pixel-border flex items-center justify-center relative overflow-hidden">

                        <!-- Main Camera Image -->
                        <img :src="currentImage" alt="Camera Image" class="object-cover w-full h-full rounded-2xl">

                        <!-- Floating Elements -->
                        <div
                            class="absolute top-4 right-4 w-8 h-8 bg-white rounded-full pixel-border flex items-center justify-center animate-float">
                            <svg class="w-4 h-4 text-pink-600" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                        </div>

                        <div class="absolute bottom-4 left-4 w-6 h-6 bg-white rounded-lg pixel-border animate-float"
                            style="animation-delay: 0.5s;"></div>
                        <div class="absolute top-1/2 right-8 w-4 h-4 bg-white rounded-full animate-float"
                            style="animation-delay: 1s;"></div>
                    </div>

                    <!-- Floating Badge -->
                    <div
                        class="absolute -top-4 -right-4 w-24 h-24 bg-pink-600 rounded-lg pixel-border flex items-center justify-center animate-float hover-glow">
                        <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ===== WEBSITE INTRODUCTION SECTION ===== -->
    <section id="introduction" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-in-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Welcome to URPOCKETDIGICAM</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Your ultimate destination for premium digital cameras and photography equipment. We specialize in
                    bringing you
                    the finest selection of cameras that fit perfectly in your pocket and your budget.
                </p>
            </div>
            <div class="grid lg:grid-cols-3 gap-8 mb-16">
                <div
                    class="text-center p-8 bg-gradient-to-br from-pink-50 to-cyan-50 rounded-2xl pixel-border hover-lift animate-fade-in-up">
                    <div
                        class="w-16 h-16 gradient-primary rounded-full flex items-center justify-center mx-auto mb-6 pixel-shadow">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Premium Cameras</h3>
                    <p class="text-gray-600 leading-relaxed">
                        From compact pocket cameras to professional DSLRs, we offer a curated selection of high-quality
                        digital cameras
                        from world-renowned brands like Canon, Sony, Nikon, and Fujifilm.
                    </p>
                </div>
                <div class="text-center p-8 bg-gradient-to-br from-cyan-50 to-pink-50 rounded-2xl pixel-border hover-lift animate-fade-in-up"
                    style="animation-delay: 0.2s;">
                    <div
                        class="w-16 h-16 gradient-primary rounded-full flex items-center justify-center mx-auto mb-6 pixel-shadow">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Quality Guaranteed</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Every camera in our collection undergoes rigorous quality checks. We ensure that each product
                        meets our high
                        standards for performance, durability, and image quality.
                    </p>
                </div>
                <div class="text-center p-8 bg-gradient-to-br from-pink-50 to-cyan-50 rounded-2xl pixel-border hover-lift animate-fade-in-up"
                    style="animation-delay: 0.4s;">
                    <div
                        class="w-16 h-16 gradient-primary rounded-full flex items-center justify-center mx-auto mb-6 pixel-shadow">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Expert Support</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Our team of photography experts is here to help you find the perfect camera for your needs. Get
                        personalized
                        recommendations and professional advice.
                    </p>
                </div>
            </div>
            {{-- <div class="text-center">
                <div class="inline-block bg-gray-100 rounded-2xl p-8 pixel-border">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">What We Sell</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-sm">
                        <div class="flex flex-col items-center">
                            <div class="w-12 h-12 bg-pink-100 rounded-lg flex items-center justify-center mb-2">
                                <span class="text-pink-600 font-bold">📱</span>
                            </div>
                            <span class="font-medium">Pocket Cameras</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-12 h-12 bg-cyan-100 rounded-lg flex items-center justify-center mb-2">
                                <span class="text-cyan-600 font-bold">📷</span>
                            </div>
                            <span class="font-medium">Mirrorless</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-12 h-12 bg-pink-100 rounded-lg flex items-center justify-center mb-2">
                                <span class="text-pink-600 font-bold">📸</span>
                            </div>
                            <span class="font-medium">DSLR Cameras</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-12 h-12 bg-cyan-100 rounded-lg flex items-center justify-center mb-2">
                                <span class="text-cyan-600 font-bold">🔧</span>
                            </div>
                            <span class="font-medium">Accessories</span>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
    <!-- ===== FEATURED PRODUCTS SECTION ===== -->
    <section id="featured-products" class="py-20 gradient-secondary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-in-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Featured Products</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Discover our handpicked selection of premium cameras from your database
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($products as $index => $product)
                    <div class="product-card pixel-border hover-lift animate-fade-in-up"
                        style="animation-delay: {{ ($index * 0.1) . 's' }};">
                        <div class="aspect-square bg-gray-100 overflow-hidden relative">
                            @if($product->image_url)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                    class="product-image w-full h-full object-cover" loading="lazy"
                                    onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjMwMCIgdmlld0JveD0iMCAwIDMwMCAzMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIzMDAiIGhlaWdodD0iMzAwIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0xNTAgMTAwQzE2MS4wNDYgMTAwIDE3MCAyMDguOTU0IDE3MCAyMjBDMTcwIDIzMS4wNDYgMTYxLjA0NiAyNDAgMTUwIDI0MEMxMzguOTU0IDI0MCAxMzAgMjMxLjA0NiAxMzAgMjIwQzEzMCAyMDguOTU0IDEzOC45NTQgMjAwIDE1MCAyMDBaIiBzdHJva2U9IiM5Q0EzQUYiIHN0cm9rZS13aWR0aD0iMiIvPgo8cGF0aCBkPSJNMTAwIDEwMEgxMDBIMjAwSDIwMFYxMDBWMjAwVjIwMEgxMDBIMTAwVjEwMFoiIHN0cm9rZT0iIzlDQTNBRiIgc3Ryb2tlLXdpZHRoPSIyIi8+Cjx0ZXh0IHg9IjE1MCIgeT0iMTcwIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBmaWxsPSIjOUNBM0FGIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiPkNhbWVyYTwvdGV4dD4KPC9zdmc+'">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            @endif
                            <!-- Stock Badge -->
                            <div class="absolute top-4 left-4">
                                @if($product->stock > 10)
                                    <span
                                        class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium pixel-border-light">
                                        In Stock ({{ $product->stock }})
                                    </span>
                                @elseif($product->stock > 0)
                                    <span
                                        class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-medium pixel-border-light">
                                        Low Stock ({{ $product->stock }})
                                    </span>
                                @else
                                    <span
                                        class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium pixel-border-light">
                                        Out of Stock
                                    </span>
                                @endif
                            </div>
                            <!-- New Badge for recently added products -->
                            @if($product->created_at->diffInDays(now()) <= 7)
                                <div class="absolute top-4 right-4">
                                    <span class="bg-pink-600 text-white px-3 py-1 rounded-full text-sm font-bold pixel-shadow">
                                        NEW
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-2">
                                <span
                                    class="text-sm text-cyan-600 font-medium bg-cyan-50 px-2 py-1 rounded pixel-border-light">
                                    {{ $product->category->name ?? 'Camera' }}
                                </span>
                                @if($product->sku)
                                    <span class="text-xs text-gray-500">SKU: {{ $product->sku }}</span>
                                @else
                                    <span class="text-xs text-gray-500">ID: {{ substr($product->id, 0, 8) }}...</span>
                                @endif
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 hover:text-pink-600 transition-colors">
                                {{ $product->name }}
                            </h3>
                            @if($product->description)
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                    {{ $product->description }}
                                </p>
                            @endif
                            <div class="flex items-center justify-between">
                                <div class="flex flex-col">
                                    <span class="text-2xl font-bold text-pink-600">
                                        Rp{{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                    @if($product->stock > 0)
                                        <span class="text-xs text-green-600 font-medium">{{ $product->stock }} units
                                            available</span>
                                    @endif
                                </div>
                                <button
                                    class="bg-cyan-500 hover:bg-cyan-600 text-white px-4 py-2 rounded-lg font-medium transition-all hover-lift pixel-shadow {{ $product->stock <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                    {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                    {{ $product->stock <= 0 ? 'Sold Out' : 'See Detail' }}
                                </button>
                            </div>
                            <!-- Product Meta Info -->
                            <div
                                class="flex items-center justify-between mt-3 pt-3 border-t border-gray-100 text-xs text-gray-500">
                                <span>Added {{ $product->created_at->diffForHumans() }}</span>
                                @if($product->weight)
                                    <span>{{ $product->weight }}kg</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <div
                            class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 pixel-border">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No Products Available</h3>
                        <p class="text-gray-600 mb-4">Add some products to your database to see them here!</p>
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center bg-pink-600 hover:bg-pink-700 text-white px-6 py-3 rounded-lg font-medium transition-all hover-lift pixel-shadow">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add Products
                        </a>
                    </div>
                @endforelse
            </div>
            @if($products->count() > 0)
                <div class="text-center mt-12">
                    <div class="inline-block bg-white rounded-lg p-6 pixel-border">
                        <p class="text-gray-600 mb-4">
                            Showing {{ $products->count() }} products from your database
                        </p>
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center bg-white hover:bg-gray-50 text-gray-900 px-8 py-4 rounded-lg font-medium transition-all hover-lift pixel-border">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Manage Products
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- ===== PRODUCT CATEGORIES SECTION ===== -->
    {{-- <section id="product-categories" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-in-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Product Categories</h2>
                <p class="text-xl text-gray-600">Explore our diverse range of camera types and accessories</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                $categories = [
                [
                'name' => 'Pocket Cameras',
                'description' => 'Compact and portable cameras perfect for everyday photography',
                'count' => '25+',
                'icon_path' => 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z', //
                Smartphone icon
                'color' => 'pink'
                ],
                [
                'name' => 'Mirrorless Cameras',
                'description' => 'Advanced mirrorless systems for professional quality',
                'count' => '40+',
                'icon_path' => 'M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0
                011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9zM15 13a3 3 0 11-6 0
                3 3 0 016 0z', // Camera icon
                'color' => 'cyan'
                ],
                [
                'name' => 'DSLR Cameras',
                'description' => 'Professional DSLR cameras for serious photographers',
                'count' => '30+',
                'icon_path' => 'M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0
                011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9zM15 13a3 3 0 11-6 0
                3 3 0 016 0z', // Camera icon (using generic camera for DSLR as well)
                'color' => 'pink'
                ],
                [
                'name' => 'Accessories',
                'description' => 'Lenses, tripods, bags, and other photography essentials',
                'count' => '100+',
                'icon_path' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94
                3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066
                2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724
                1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0
                00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31
                2.37-2.37.996.608 2.296.07 2.572-1.065z', // Sliders icon
                'color' => 'cyan'
                ]
                ];
                @endphp
                @foreach($categories as $index => $category)
                <div class="category-card pixel-border hover-lift animate-fade-in-up"
                    style="animation-delay: {{ $index * 0.1 }}s;">
                    <div
                        class="w-16 h-16 bg-{{ $category['color'] }}-100 rounded-full flex items-center justify-center mx-auto mb-6 pixel-shadow">
                        <svg class="w-8 h-8 text-{{ $category['color'] }}-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="{{ $category['icon_path'] }}"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $category['name'] }}</h3>
                    <p class="text-gray-600 mb-4 text-sm leading-relaxed">{{ $category['description'] }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-{{ $category['color'] }}-600 font-bold">{{ $category['count'] }}
                            Products</span>
                        <button
                            class="text-{{ $category['color'] }}-600 hover:text-{{ $category['color'] }}-700 font-medium transition-colors">
                            Explore →
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section> --}}
    <!-- ===== BRANDS SECTION ===== -->
    <section id="categories" class="py-20 gradient-secondary" x-data="{
        categories: [],
        loadingCategories: true,
        errorCategories: null,
        categoriesApiUrl: '{{ route('getBrandsByCategory') }}', // URL Laravel kamu
        async fetchCategories() {
            this.loadingCategories = true;
            this.errorCategories = null;
            try {
                const response = await fetch(this.categoriesApiUrl);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                this.categories = await response.json();
            } catch (error) {
                console.error('Error fetching categories:', error);
                this.errorCategories = 'Failed to load categories. Please try again later.';
            } finally {
                this.loadingCategories = false;
            }
        },
        init() {
            this.fetchCategories();
        }
    }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-in-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Product Categories</h2>
                <p class="text-xl text-gray-600">Browse our collection by category</p>
            </div>

            <!-- Loader -->
            <div x-show="loadingCategories" class="text-center py-8">
                <svg class="animate-spin h-8 w-8 text-pink-600 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                <p class="mt-4 text-gray-600">Loading categories...</p>
            </div>

            <!-- Error Message -->
            <div x-show="errorCategories" x-text="errorCategories" class="text-center text-red-600 py-8"></div>

            <!-- Category Grid -->
            <div x-show="!loadingCategories && !errorCategories"
                class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8">
                <template x-for="(category, index) in categories" :key="category.id">
                    <div class="group hover:shadow-lg transition-all duration-300 pixel-border bg-white rounded-lg hover-lift animate-fade-in-up"
                        :style="`animation-delay: ${index * 0.1}s;`">
                        <div class="p-6 text-center">
                            <h3 class="font-semibold text-gray-900 mb-2" x-text="category.name"></h3>
                            <p class="text-sm text-gray-500 mb-4" x-text="`${category.total} Products`"></p>
                            <button
                                class="w-full px-4 py-2 border-2 border-cyan-300 text-cyan-600 hover:bg-cyan-50 bg-transparent rounded-lg font-medium transition-all hover-lift pixel-border-light">
                                See Products
                            </button>
                        </div>
                    </div>
                </template>

                <!-- Empty State -->
                <div x-show="categories.length === 0 && !loadingCategories && !errorCategories"
                    class="col-span-full text-center py-12">
                    <div
                        class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 pixel-border">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No Categories Available</h3>
                    <p class="text-gray-600 mb-4">Add some products to categories to display them here.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== CONTACT SECTION ===== -->
    <section id="contact" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-in-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Get in Touch</h2>
                <p class="text-xl text-gray-600">Have questions? We'd love to hear from you</p>
            </div>
            <div class="grid lg:grid-cols-2 gap-12">
                <div class="animate-fade-in-up">
                    <div class="pixel-border bg-white rounded-lg shadow-lg">
                        <div class="p-8">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">Send us a message</h3>
                            <form class="space-y-6" x-data="{
        name: '',
        email: '',
        message: '',
        isSubmitting: false,
        async submitForm() {
            if (!this.name || !this.email || !this.message) {
                alert('Please fill in all fields');
                return;
            }
            this.isSubmitting = true;
            try {
                // Simulate API call
                await new Promise(resolve => setTimeout(resolve, 1500));
                // Reset form
                this.name = '';
                this.email = '';
                this.message = '';
                alert('Message sent successfully! We will get back to you soon.');
            } catch (error) {
                alert('Error sending message. Please try again.');
            } finally {
                this.isSubmitting = false;
            }
        }
    }">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name
                                        *</label>
                                    <input type="text" id="name" x-model="name" placeholder="Your full name"
                                        class="contact-input w-full pixel-border-light" required>
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email
                                        *</label>
                                    <input type="email" id="email" x-model="email" placeholder="your@email.com"
                                        class="contact-input w-full pixel-border-light" required>
                                </div>
                                <div>
                                    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message
                                        *</label>
                                    <textarea rows="4" id="message" x-model="message"
                                        placeholder="Tell us about your photography needs..."
                                        class="contact-input w-full pixel-border-light resize-none" required></textarea>
                                </div>
                                <button type="button" @click="submitForm()" :disabled="isSubmitting"
                                    class="w-full bg-pink-600 hover:bg-pink-700 text-white px-6 py-3 rounded-lg font-medium transition-all hover-lift pixel-shadow disabled:opacity-50 disabled:cursor-not-allowed">
                                    <span x-show="!isSubmitting">Send Message</span>
                                    <span x-show="isSubmitting" class="flex items-center justify-center">
                                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4" />
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                                        </svg>
                                        Sending...
                                    </span>
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="space-y-8 animate-slide-in-right">
                    <div class="pixel-border bg-white rounded-lg hover-lift shadow-lg">
                        <div class="p-6">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="w-12 h-12 bg-cyan-100 rounded-lg flex items-center justify-center pixel-shadow">
                                    <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">WhatsApp</h4>
                                    <p class="text-gray-600">+62 123 456 7890</p>
                                    <a href="https://wa.me/6212345678900"
                                        class="text-cyan-600 hover:text-cyan-700 text-sm font-medium">
                                        Chat with us →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pixel-border bg-white rounded-lg hover-lift shadow-lg">
                        <div class="p-6">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="w-12 h-12 bg-pink-100 rounded-lg flex items-center justify-center pixel-shadow">
                                    <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Email</h4>
                                    <p class="text-gray-600">info@urpocketdigicam.com</p>
                                    <a href="mailto:info@urpocketdigicam.com"
                                        class="text-pink-600 hover:text-pink-700 text-sm font-medium">
                                        Send email →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pixel-border bg-white rounded-lg hover-lift shadow-lg">
                        <div class="p-6">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="w-12 h-12 bg-cyan-100 rounded-lg flex items-center justify-center pixel-shadow">
                                    <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Visit Our Store</h4>
                                    <p class="text-gray-600">Jakarta, Indonesia</p>
                                    <a href="#" class="text-cyan-600 hover:text-cyan-700 text-sm font-medium">
                                        Get directions →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pixel-border bg-white rounded-lg hover-lift shadow-lg">
                        <div class="p-6">
                            <h4 class="font-semibold text-gray-900 mb-4">Business Hours</h4>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Monday - Friday</span>
                                    <span class="font-medium">9:00 AM - 6:00 PM</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Saturday</span>
                                    <span class="font-medium">9:00 AM - 4:00 PM</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Sunday</span>
                                    <span class="font-medium text-red-600">Closed</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ===== FOOTER ===== -->
    <footer class="gradient-dark text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-1 mb-4">
                        <img src="{{ asset('images/camnobg.png') }}" class="w-11 h-10 " alt="logo">
                        <span class="text-xl font-bold">
                            <span class="text-cyan-400">URPOCKET</span><span class="text-pink-400">DIGICAM</span>
                        </span>
                    </div>
                    <p class="text-gray-400 mb-6 max-w-md leading-relaxed">
                        Your trusted partner for professional photography equipment. Helping you capture life's precious
                        moments
                        with quality cameras and gear since 2020.
                    </p>
                    <div class="space-y-3">
                        <a href="https://instagram.com/urpocketdigicam"
                            class="flex items-center space-x-3 text-gray-400 hover:text-pink-400 transition-colors group">
                            <div
                                class="w-8 h-8 bg-pink-600 rounded-lg flex items-center justify-center group-hover:bg-pink-500 transition-colors">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987s11.987-5.367 11.987-11.987C24.004 5.367 18.637.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.49-3.323-1.297C4.198 14.895 3.708 13.744 3.708 12.447s.49-2.448 1.418-3.323c.928-.875 2.026-1.297 3.323-1.297s2.448.422 3.323 1.297c.875.875 1.297 1.975 1.297 3.323s-.422 2.448-1.297 3.323c-.875.807-2.026 1.297-3.323 1.297zm7.83-9.781c-.49 0-.928-.175-1.297-.49-.368-.368-.49-.807-.49-1.297s.122-.928.49-1.297c.369-.368.807-.49 1.297-.49s.928.122 1.297.49c.368.369.49.807.49 1.297s-.122.928-.49 1.297c-.369.315-.807.49-1.297.49z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="font-medium">@urpocketdigicam</span>
                        </a>
                        <a href="https://tiktok.com/@urpocketdigicam"
                            class="flex items-center space-x-3 text-gray-400 hover:text-cyan-400 transition-colors group">
                            <div
                                class="w-8 h-8 bg-cyan-600 rounded-lg flex items-center justify-center group-hover:bg-cyan-500 transition-colors">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-.88-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1-.1z" />
                                </svg>
                            </div>
                            <span class="font-medium">@urpocketdigicam</span>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><button @click="scrollToSection('featured-products')"
                                class="text-gray-400 hover:text-white transition-colors">Products</button></li>
                        <li><button @click="scrollToSection('product-categories')"
                                class="text-gray-400 hover:text-white transition-colors">Categories</button></li>
                        <li><button @click="scrollToSection('brands')"
                                class="text-gray-400 hover:text-white transition-colors">Brands</button></li>
                        <li><button @click="scrollToSection('introduction')"
                                class="text-gray-400 hover:text-white transition-colors">About</button></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Support</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Help Center</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Shipping Info</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Returns & Warranty</a>
                        </li>
                        <li><button @click="scrollToSection('contact')"
                                class="text-gray-400 hover:text-white transition-colors">Contact Us</button></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm">© {{ date('Y') }} URPOCKETDIGICAM. All rights reserved.</p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Privacy Policy</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Terms of
                            Service</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ===== JAVASCRIPT ===== -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        // ===== PERFORMANCE OPTIMIZATIONS =====
        document.addEventListener('DOMContentLoaded', function () {
            // Lazy load images
            const images = document.querySelectorAll('img[data-src]');
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('loading');
                        imageObserver.unobserve(img);
                    }
                });
            });
            images.forEach(img => imageObserver.observe(img));
            // Animate elements on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in-up');
                    }
                });
            }, observerOptions);
            // Observe elements for animation
            const animateElements = document.querySelectorAll('.animate-on-scroll');
            animateElements.forEach(el => observer.observe(el));
        });
        // ===== UTILITY FUNCTIONS =====
        window.utils = {
            // Format currency
            formatCurrency(amount, currency = 'IDR') {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: currency,
                    minimumFractionDigits: 0
                }).format(amount);
            },
            // Debounce function
            debounce(func, wait) {
                let timeout;
                return function executedFunction(...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func(...args);
                    };
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            },
            // Smooth scroll to element
            scrollTo(elementId, offset = 80) {
                const element = document.getElementById(elementId);
                if (element) {
                    const elementPosition = element.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - offset;
                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            },
            // Check if element is in viewport
            isInViewport(element) {
                const rect = element.getBoundingClientRect();
                return (
                    rect.top >= 0 &&
                    rect.left >= 0 &&
                    rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                    rect.right <= (window.innerWidth || document.documentElement.clientWidth)
                );
            }
        };
        // ===== GLOBAL ERROR HANDLING =====
        window.addEventListener('error', (e) => {
            console.error('Global error:', e.error);
        });
        // ===== ANALYTICS TRACKING =====
        function trackEvent(eventName, properties = {}) {
            // Add your analytics tracking code here
            console.log('Event tracked:', eventName, properties);
        }
        // Track page view
        trackEvent('page_view', {
            page: 'home',
            timestamp: new Date().toISOString()
        });
    </script>
</body>

</html>