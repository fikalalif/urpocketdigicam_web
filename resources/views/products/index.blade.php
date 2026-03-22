<x-layouts.app :title="__('Produk')">
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Daftar Produk</h1>
            <a href="{{ route('products.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 transition">
                + Tambah Produk
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
                        <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider">Gambar</th>
                        <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider">Nama</th>
                        <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider">Kategori</th>
                        <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider">Tipe</th>
                        <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider">Harga Jual</th>
                        <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider">Harga Sewa</th>
                        <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider">Stok</th>
                        <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                    @forelse($products as $product)
                        <tr>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-12 h-12 object-cover rounded-lg">
                            </td>
                            <td class="px-4 py-4">
                                <div class="font-medium">{{ $product->name }}</div>
                                <div class="text-xs text-zinc-500">{{ $product->sku ?? '-' }}</div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs bg-zinc-100 dark:bg-zinc-800 rounded">
                                    {{ $product->category->name ?? '-' }}
                                </span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap uppercase text-xs font-bold">
                                {{ $product->type }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                Rp{{ number_format($product->price, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                Rp{{ number_format($product->rental_price, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                {{ $product->stock }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm space-x-2">
                                <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-8 text-center text-zinc-500">Belum ada produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</x-layouts.app>
