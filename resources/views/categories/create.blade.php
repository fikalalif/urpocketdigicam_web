<x-layouts.app :title="'Kategori Produk'">

    <div class="container mx-auto p-6">
        <form action="{{ route('categories.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Nama Kategori</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="w-full border rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring focus:border-blue-300">
                @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>