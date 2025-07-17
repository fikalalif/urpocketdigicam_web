<x-layouts.app :title="__('Dashboard')">
    <div class="gradient-secondary min-h-screen flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-4xl animate-fade-in-up">
            <div class="bg-white rounded-2xl p-8 md:p-12 space-y-8 pixel-border pixel-shadow-lg text-center">
                <div class="flex flex-col items-center mb-6">
                    <!-- Logo: Width > Height -->
                    <img src="{{ asset('images/cam.jpg') }}" alt="URPOCKETDIGICAM Logo"
                        class="w-28 h-24 mb-4 pixel-border rounded bg-cyan-300 p-3 hover-lift object-contain">
                    
                    <h1 class="text-4xl font-bold text-gray-900 mb-2 text-shadow">
                        Selamat Datang di Dashboard!
                    </h1>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                        Kelola koleksi kamera digital Anda dengan mudah dan profesional.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">
                    <!-- Card 1 -->
                    <div class="bg-gradient-to-br from-pink-50 to-cyan-50 rounded-xl p-6 pixel-border hover-lift">
                        <div class="flex items-center justify-center w-16 h-16 bg-pink-600 rounded-full mx-auto mb-4 pixel-shadow">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">125</h3>
                        <p class="text-gray-600">Total Produk</p>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-gradient-to-br from-cyan-50 to-pink-50 rounded-xl p-6 pixel-border hover-lift">
                        <div class="flex items-center justify-center w-16 h-16 bg-cyan-600 rounded-full mx-auto mb-4 pixel-shadow">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">12</h3>
                        <p class="text-gray-600">Pesanan Baru</p>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-gradient-to-br from-pink-50 to-cyan-50 rounded-xl p-6 pixel-border hover-lift">
                        <div class="flex items-center justify-center w-16 h-16 bg-pink-600 rounded-full mx-auto mb-4 pixel-shadow">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">543</h3>
                        <p class="text-gray-600">Pengunjung Hari Ini</p>
                    </div>
                </div>

                <div class="mt-12">
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center bg-cyan-600 hover:bg-cyan-700 text-white px-8 py-4 text-lg rounded-lg pixel-shadow font-medium transition-all hover-lift">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
