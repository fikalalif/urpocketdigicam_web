<x-layouts.app :title="__('Dashboard')">
    <div class="gradient-secondary min-h-screen flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-4xl animate-fade-in-up">
            <div class="bg-white rounded-2xl p-8 md:p-12 space-y-8 pixel-border pixel-shadow-lg text-center">
                <div class="flex flex-col items-center mb-6">
                    <img src="{{ asset('images/cam.jpg') }}" alt="URPOCKETDIGICAM Logo" class="w-24 h-24 mb-4 pixel-border rounded-full bg-cyan-300 p-3 hover-lift">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2 text-shadow">Selamat Datang di Dashboard!</h1>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">Kelola koleksi kamera digital Anda dengan mudah dan profesional.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">
                    <!-- Card 1 -->
                    <div class="bg-gradient-to-br from-pink-50 to-cyan-50 rounded-xl p-6 pixel-border hover-lift">
                        <div class="flex items-center justify-center w-16 h-16 bg-pink-600 rounded-full mx-auto mb-4 pixel-shadow">
                            <svg class="w-8 h-8 text-white" ...></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">125</h3>
                        <p class="text-gray-600">Total Produk</p>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-gradient-to-br from-cyan-50 to-pink-50 rounded-xl p-6 pixel-border hover-lift">
                        <div class="flex items-center justify-center w-16 h-16 bg-cyan-600 rounded-full mx-auto mb-4 pixel-shadow">
                            <svg class="w-8 h-8 text-white" ...></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">12</h3>
                        <p class="text-gray-600">Pesanan Baru</p>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-gradient-to-br from-pink-50 to-cyan-50 rounded-xl p-6 pixel-border hover-lift">
                        <div class="flex items-center justify-center w-16 h-16 bg-pink-600 rounded-full mx-auto mb-4 pixel-shadow">
                            <svg class="w-8 h-8 text-white" ...></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">543</h3>
                        <p class="text-gray-600">Pengunjung Hari Ini</p>
                    </div>
                </div>

                <div class="mt-12">
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center bg-cyan-600 hover:bg-cyan-700 text-white px-8 py-4 text-lg rounded-lg pixel-shadow font-medium transition-all hover-lift">
                        <svg class="w-5 h-5 mr-2" ...></svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
