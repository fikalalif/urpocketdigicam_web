<x-layouts.app :title="__('Dashboard')">
    <div
        class="min-h-screen flex flex-col items-center justify-start pt-10 px-6 sm:px-6 lg:px-8 relative overflow-hidden bg-pulse-gradient">

        {{-- Background Grid & Gradients --}}
        <div class="absolute inset-0 opacity-10 dark:opacity-5 pointer-events-none"
            style="background-image: radial-gradient(circle at center, hsl(var(--primary)) 1px, transparent 1px); background-size: 30px 30px; animation: fade-in 2s ease-out;">
        </div>
        <div
            class="absolute inset-0 bg-gradient-to-br from-transparent via-background/10 to-background/20 dark:via-background/20 dark:to-background/30 animate-fade-in">
        </div>

        <div class="w-[90%] max-w-5xl animate-fade-in-up relative z-10 mx-auto">
            <div
                class="bg-card text-card-foreground rounded-2xl p-6 md:p-10 space-y-6 border border-border shadow-2xl text-center relative overflow-hidden transition-all duration-500 ease-in-out hover:scale-[1.01] hover:shadow-3xl card-gradient">
                {{-- Subtle internal pattern --}}
                <div class="absolute inset-0 opacity-10 dark:opacity-5 pointer-events-none"
                    style="background-image: radial-gradient(#000000 1px, transparent 1px); background-size: 15px 15px;">
                </div>

                <div class="flex flex-col items-center mb-4 relative z-10">
                    <img src="{{ asset('images/cam.jpg') }}" alt="URPOCKETDIGICAM Logo"
                        class="w-24 h-20 mb-4 border-3 border-primary rounded-xl bg-secondary p-2 hover-lift object-contain shadow-lg transition-all duration-500 ease-in-out transform hover:scale-105 animate-fade-in-up delay-100">
                    <h1
                        class="text-3xl sm:text-4xl font-extrabold text-foreground mb-3 text-shadow animate-fade-in-up delay-200 tracking-tight">
                        Selamat Datang di <span class="text-primary">Toko Kami</span>!
                    </h1>
                    <p
                        class="text-sm sm:text-base md:text-lg text-muted-foreground max-w-2xl mx-auto animate-fade-in-up delay-300 leading-snug sm:leading-relaxed tracking-normal sm:tracking-tight px-2 sm:px-0">
                        Kelola koleksi kamera digital Anda dengan antarmuka modern yang intuitif, responsif, dan penuh
                        gaya sempurna untuk pengalaman pengguna yang maksimal.
                    </p>

                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8 relative z-10">
                    {{-- Total Produk --}}
                    <div
                        class="group bg-background rounded-xl p-5 border border-border shadow-md hover-lift transition-all duration-300 ease-in-out transform hover:scale-[1.02] hover:shadow-xl card-gradient animate-fade-in-up delay-400">
                        <div
                            class="flex items-center justify-center w-14 h-14 bg-primary text-primary-foreground rounded-full mx-auto mb-3 shadow-lg group-hover:scale-110 group-hover:bg-primary/90 transition">
                            {{-- Camera Icon --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path
                                    d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3Z" />
                                <circle cx="12" cy="13" r="3" />
                            </svg>
                        </div>
                        <h3 class="text-2xl sm:text-3xl font-bold text-foreground mb-1">125</h3>
                        <p class="text-muted-foreground text-sm sm:text-base">Total Produk</p>
                    </div>

                    {{-- Pesanan Baru --}}
                    <div
                        class="group bg-background rounded-xl p-5 border border-border shadow-md hover-lift transition-all duration-300 ease-in-out transform hover:scale-[1.02] hover:shadow-xl card-gradient animate-fade-in-up delay-500">
                        <div
                            class="flex items-center justify-center w-14 h-14 bg-primary text-primary-foreground rounded-full mx-auto mb-3 shadow-lg group-hover:scale-110 group-hover:bg-primary/90 transition">
                            {{-- Clipboard List Icon --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                                <path d="M15 2H9a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1Z" />
                                <path d="M8 12h8" />
                                <path d="M8 16h6" />
                            </svg>
                        </div>
                        <h3 class="text-2xl sm:text-3xl font-bold text-foreground mb-1">12</h3>
                        <p class="text-muted-foreground text-sm sm:text-base">Pesanan Baru</p>
                    </div>

                    {{-- Pengunjung Hari Ini --}}
                    <div
                        class="group bg-background rounded-xl p-5 border border-border shadow-md hover-lift transition-all duration-300 ease-in-out transform hover:scale-[1.02] hover:shadow-xl card-gradient animate-fade-in-up delay-600">
                        <div
                            class="flex items-center justify-center w-14 h-14 bg-primary text-primary-foreground rounded-full mx-auto mb-3 shadow-lg group-hover:scale-110 group-hover:bg-primary/90 transition">
                            {{-- Users Icon --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                        </div>
                        <h3 class="text-2xl sm:text-3xl font-bold text-foreground mb-1">543</h3>
                        <p class="text-muted-foreground text-sm sm:text-base">Pengunjung Hari Ini</p>
                    </div>
                </div>

                <div class="mt-10 relative z-10 animate-fade-in-up delay-700">
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center bg-primary text-primary-foreground px-5 py-2.5 text-base sm:px-7 sm:py-3.5 rounded-full shadow-lg font-semibold transition-all duration-300 ease-in-out hover:bg-primary/90 hover:scale-105 hover-lift">
                        {{-- Arrow Left Icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 19l-7-7 7-7" />
                            <path d="M19 12H5" />
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>