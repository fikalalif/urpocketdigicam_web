<x-layouts.app :title="'Edit Kategori Produk'">

    <div class="container mx-auto p-6">
        <form action="{{ route('categories.update', $category->id) }}" method="POST"
              class="bg-white p-6 rounded shadow-md">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Nama Kategori</label>
                <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}"
                       class="w-full border rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring focus:border-blue-300">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="is_active" class="block text-gray-700 font-semibold mb-2">Status Aktif</label>
                <select name="is_active" id="is_active"
                        class="w-full border rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring focus:border-blue-300">
                    <option value="1" {{ $category->is_active ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ !$category->is_active ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Perbarui
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
