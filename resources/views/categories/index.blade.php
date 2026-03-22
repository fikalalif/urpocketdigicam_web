<x-layouts.app :title="__('Kategori')">
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Daftar Kategori</h1>
            <a href="{{ route('categories.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 transition">
                + Tambah Kategori
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-800 overflow-hidden shadow-sm">
            <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-800">
                <thead class="bg-zinc-50 dark:bg-zinc-800/50">
                    <tr>
                        <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider">Nama</th>
                        <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider">Deskripsi</th>
                        <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider">Visibilitas</th>
                        <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                    @forelse($categories as $category)
                        <tr>
                            <td class="px-4 py-4 font-medium whitespace-nowrap">
                                {{ $category->name }}
                            </td>
                            <td class="px-4 py-4 text-sm text-zinc-500">
                                {{ $category->description ?? '-' }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                @if($category->is_visible)
                                    <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded-full">Visible</span>
                                @else
                                    <span class="px-2 py-1 text-xs bg-zinc-100 text-zinc-700 rounded-full">Hidden</span>
                                @endif
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm space-x-2">
                                <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-zinc-500">Belum ada kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $categories->links() }}
        </div>
    </div>
</x-layouts.app>
