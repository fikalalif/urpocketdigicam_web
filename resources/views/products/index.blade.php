<x-layouts.app :title="'Daftar Produk'">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Daftar Produk</h1>

        <a href="{{ route('products.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded mb-4 inline-block">
            + Tambah Produk
        </a>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <table class="min-w-full bg-white shadow rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border-b text-left">Nama Produk</th>
                    <th class="px-4 py-2 border-b text-left">Harga</th>
                    <th class="px-4 py-2 border-b text-left">Stok</th>
                    <th class="px-4 py-2 border-b text-left">Status (Hub)</th>
                    <th class="px-4 py-2 border-b text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $product->name }}</td>
                        <td class="px-4 py-2 border-b">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="px-4 py-2 border-b">{{ $product->stock }}</td>
                        <td class="px-4 py-2 border-b">
                            @if ($product->is_active)
                                <span class="text-green-600 font-semibold">Aktif</span>
                            @else
                                <span class="text-red-600 font-semibold">Non-Aktif</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border-b space-x-1">
                            <a href="{{ route('products.edit', $product->id) }}" class="bg-green-500 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">Edit</a>

                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">Hapus</button>
                            </form>

                            <form action="{{ route('products.syncToHub', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Sinkronkan ke Hub?')">
                                @csrf
                                <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white px-3 py-1 rounded text-sm">🔄 Sync</button>
                            </form>

                            @if ($product->is_active)
                                <form action="{{ route('products.setInactive', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Non-aktifkan produk di Hub?')">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white px-3 py-1 rounded text-sm">🔻 Non-Aktifkan</button>
                                </form>
                            @else
                                <form action="{{ route('products.setActive', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Aktifkan produk di Hub?')">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">🔺 Aktifkan</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</x-layouts.app>