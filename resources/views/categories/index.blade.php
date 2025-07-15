<x-layouts.app :title="'Kategori Produk'">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Daftar Kategori</h1>

        {{-- Flash Messages --}}
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

        {{-- Table --}}
        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b text-left">Nama Kategori</th>
                    <th class="px-4 py-2 border-b text-left">Status Sinkron</th>
                    <th class="px-4 py-2 border-b text-left">Sinkron ke Hub</th>
                    <th class="px-4 py-2 border-b text-left">Sync Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $category->name }}</td>
                        <td class="px-4 py-2 border-b">
                            @if ($category->hub_category_id)
                                <span class="text-green-600">Tersinkron (ID: {{ $category->hub_category_id }})</span>
                            @else
                                <span class="text-red-600">Belum Sinkron</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border-b">
                            {{-- Tombol Sinkronisasi ke Hub --}}
                            @if (!$category->hub_category_id)
                                <form action="{{ route('category.sync', ['id' => $category->id]) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="is_active" value="{{ $category->is_active ? 1 : 0 }}">
                                    <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                        Sinkronkan ke Hub
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-500 text-sm">✓ Sudah Sinkron</span>
                            @endif
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</x-layouts.app>
