<x-layouts.app :title="'Kategori Produk'">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Daftar Kategori</h1>

        <a href="{{ route('categories.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded mb-4 inline-block">
            + Tambah Kategori
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

        <table class="min-w-full bg-white shadow rounded text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border-b text-left">Nama Kategori</th>
                    <th class="px-4 py-2 border-b text-left">Status Hub</th>
                    <th class="px-4 py-2 border-b text-left">Tampil di Web</th>
                    <th class="px-4 py-2 border-b text-left">Aksi Hub</th>
                    <th class="px-4 py-2 border-b text-left">Aksi Lokal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b font-semibold">{{ $category->name }}</td>

                        <td class="px-4 py-2 border-b">
                            @if ($category->hub_category_id)
                                <span class="inline-block bg-green-100 text-green-800 px-2 py-1 rounded text-xs">
                                    Hub Aktif
                                </span>
                                @if (!$category->is_active)
                                    <span class="inline-block bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs ml-1">
                                        Tidak Aktif di Hub
                                    </span>
                                @endif
                            @else
                                <span class="inline-block bg-red-100 text-red-800 px-2 py-1 rounded text-xs">
                                    Belum Sinkron
                                </span>
                            @endif
                        </td>

                        <td class="px-4 py-2 border-b">
                            @if ($category->is_visible)
                                <span class="text-green-600 font-semibold text-xs">✔ Ditampilkan</span>
                            @else
                                <span class="text-gray-500 font-semibold text-xs">✖ Tidak Ditampilkan</span>
                            @endif
                        </td>

                        <td class="px-4 py-2 border-b space-y-1">
                            @if (!$category->hub_category_id)
                                <form action="{{ route('categories.syncToHub', $category->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="bg-indigo-500 hover:bg-indigo-700 text-white px-3 py-1 rounded text-xs">
                                        🔄 Sync ke Hub
                                    </button>
                                </form>
                            @elseif ($category->is_active)
                                <form action="{{ route('categories.deactivateOnHub', $category->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menonaktifkan di Hub?');">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="bg-yellow-500 hover:bg-yellow-700 text-white px-3 py-1 rounded text-xs">
                                        🔻 Nonaktifkan di Hub
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('categories.syncToHub', $category->id) }}" method="POST"
                                    onsubmit="return confirm('Aktifkan kembali di Hub?');">
                                    @csrf
                                    <button type="submit"
                                        class="bg-green-500 hover:bg-green-700 text-white px-3 py-1 rounded text-xs">
                                        🔺 Aktifkan di Hub
                                    </button>
                                </form>
                            @endif
                        </td>

                        <td class="px-4 py-2 border-b space-x-1">
                            <a href="{{ route('categories.edit', $category->id) }}"
                                class="bg-green-500 hover:bg-green-700 text-white px-3 py-1 rounded text-xs">
                                ✏ Edit
                            </a>

                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                class="inline-block ml-1"
                                onsubmit="return confirm('Hapus kategori ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">
                                    🗑 Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $categories->links() }}
        </div>
    </div>
</x-layouts.app>