<x-layouts.app :title="__('Dashboard')">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Produk') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Tambah Produk Baru</h2>

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Nama Produk -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold mb-1">Nama Produk</label>
                    <input type="text" name="name" id="name" 
                           value="{{ old('name') }}"
                           class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Kategori -->
                <div class="mb-4">
                    <label for="category_id" class="block text-gray-700 font-semibold mb-1">Kategori</label>
                    <select name="category_id" id="category_id"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                

                <!-- Harga -->
                <div class="mb-4">
                    <label for="price" class="block text-gray-700 font-semibold mb-1">Harga</label>
                    <input type="number" name="price" id="price" step="0.01" 
                           value="{{ old('price') }}"
                           class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                

                <!-- Deskripsi -->
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-semibold mb-1">Deskripsi</label>
                    <textarea name="description" id="description" rows="3"
                              class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
                    @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="stock" class="block text-gray-700 font-semibold mb-1">Stock</label>
                    <input type="number" name="stock" id="stock" step="0.01" 
                           value="{{ old('stock') }}"
                           class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('stock') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Gambar -->
                <div class="mb-6">
                    <label for="image" class="block text-gray-700 font-semibold mb-1">Gambar Produk</label>
                    <input type="file" name="image" id="image"
                           class="w-56 text-gray-700  bg-blue-900">
                    @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Tombol -->
                <div class="flex justify-end">
                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg shadow-sm">
                        Tambah Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
