<x-layouts.app :title="'Tambah Kategori'">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Tambah Kategori</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block font-semibold mb-1">Nama Kategori</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="w-full border px-3 py-2 rounded" required>
            </div>

            <div>
                <label for="description" class="block font-semibold mb-1">Deskripsi</label>
                <textarea name="description" id="description" rows="3"
                    class="w-full border px-3 py-2 rounded">{{ old('description') }}</textarea>
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="is_visible" id="is_visible" value="1" class="mr-2" checked>
                <label for="is_visible" class="font-semibold">Tampilkan di Website Lokal</label>
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Simpan
            </button>
        </form>
    </div>
</x-layouts.app>