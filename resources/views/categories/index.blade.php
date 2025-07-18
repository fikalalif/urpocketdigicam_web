<x-layouts.app :title="'Kategori Produk'">
    <div class="container mx-auto px-4 py-8 animate-fade-in">
        <div class="flex flex-col sm:flex-row items-center justify-between mb-8 gap-4">
            <h1 class="text-4xl font-extrabold text-foreground text-shadow">Daftar Kategori</h1>
            <a href="{{ route('categories.create') }}" class="inline-flex items-center justify-center rounded-full text-base font-semibold transition-colors h-12 px-6 py-3 bg-primary text-primary-foreground hover:bg-primary/90 shadow-lg hover-lift">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus size-5 mr-2"><path d="M12 5v14"/><path d="M5 12h14"/></svg>
                Tambah Kategori Baru
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6 dark:bg-green-900 dark:text-green-200 dark:border-green-700 animate-fade-in shadow-md" role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6 dark:bg-red-900 dark:text-red-200 dark:border-red-700 animate-fade-in shadow-md" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-card text-card-foreground shadow-2xl rounded-xl overflow-hidden border border-border card-gradient">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead class="bg-muted text-muted-foreground border-b border-border">
                        <tr>
                            <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider">Nama Kategori</th>
                            <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider">Status Hub</th>
                            <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider">Tampil di Web</th>
                            <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider">Aksi Hub</th>
                            <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider">Aksi Lokal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        @forelse ($categories as $category)
                            <tr class="table-row-hover transition-colors duration-200">
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-foreground">{{ $category->name }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm">
                                    @if ($category->hub_category_id)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 shadow-sm">
                                            Hub Aktif
                                        </span>
                                        @if (!$category->is_active)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 ml-1 dark:bg-yellow-900 dark:text-yellow-200 shadow-sm">
                                                Tidak Aktif di Hub
                                            </span>
                                        @endif
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 shadow-sm">
                                            Belum Sinkron
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm">
                                    @if ($category->is_visible)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check size-3.5 mr-1"><path d="M20 6 9 17l-5-5"/></svg>
                                            Ditampilkan
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x size-3.5 mr-1"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                                            Tidak Ditampilkan
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm space-x-1">
                                    @if (!$category->hub_category_id)
                                        <form action="{{ route('categories.syncToHub', $category->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center justify-center rounded-md text-xs font-medium transition-colors h-9 px-3.5 py-1.5 bg-indigo-500 text-white hover:bg-indigo-600 shadow-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-refresh-cw size-4 mr-1"><path d="M21 12a9 9 0 0 0-9-9c-7.2 0-9 1.8-9 9s1.8 9 9 9c1.68 0 3.24-.35 4.6-.96"/><path d="M21 3v9h-9"/></svg>
                                                Sync ke Hub
                                            </button>
                                        </form>
                                    @elseif ($category->is_active)
                                        <form action="{{ route('categories.deactivateOnHub', $category->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menonaktifkan di Hub?');">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="inline-flex items-center justify-center rounded-md text-xs font-medium transition-colors h-9 px-3.5 py-1.5 bg-yellow-500 text-white hover:bg-yellow-600 shadow-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-toggle-right size-4 mr-1"><rect width="20" height="12" x="2" y="6" rx="6"/><path d="M16 12H20"/></svg>
                                                Nonaktifkan di Hub
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('categories.syncToHub', $category->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Aktifkan kembali di Hub?');">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center justify-center rounded-md text-xs font-medium transition-colors h-9 px-3.5 py-1.5 bg-green-500 text-white hover:bg-green-600 shadow-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-toggle-left size-4 mr-1"><rect width="20" height="12" x="2" y="6" rx="6"/><path d="M8 12H4"/></svg>
                                                Aktifkan di Hub
                                            </button>
                                        </form>
                                    @endif
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm space-x-1">
                                    <a href="{{ route('categories.edit', $category->id) }}" class="inline-flex items-center justify-center rounded-md text-xs font-medium transition-colors h-9 px-3.5 py-1.5 bg-accent text-accent-foreground hover:bg-accent/90 shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil size-4 mr-1"><path d="M17 3a2.85 2.85 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="M15 5l4 4"/></svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-block ml-1" onsubmit="return confirm('Hapus kategori ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center rounded-md text-xs font-medium transition-colors h-9 px-3.5 py-1.5 bg-destructive text-destructive-foreground hover:bg-destructive/90 shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2 size-4 mr-1"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-muted-foreground text-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-folder-open inline-block size-8 mb-2 text-muted-foreground/60"><path d="M6 17a3 3 0 0 0 3 3h10a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-8a2 2 0 0 1-1.414-.586L4.586 4.414A2 2 0 0 0 3.172 4H2v14a2 2 0 0 0 2 2h2"/><path d="M15 10h-5l-2 2h7l-2 2h-5"/></svg>
                                    <p>Tidak ada kategori ditemukan. Mulai tambahkan kategori baru!</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8 flex justify-center">
            {{ $categories->links() }}
        </div>
    </div>
</x-layouts.app>
