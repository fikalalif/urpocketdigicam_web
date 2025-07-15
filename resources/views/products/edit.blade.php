<x-layouts.app :title="__('Dashboard')">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Produk') }}
        </h2>
    </x-slot>
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md mt-10">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6 border-b pb-2">Edit Produk</h1>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nama Produk -->
            <div class="mb-5">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="category_id" id="category_id"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
                @error('category_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Harga -->
            <div class="mb-5">
                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                <input type="number" name="price" id="price" step="0.01"
                    value="{{ old('price', $product->price) }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('price')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kategori -->
            

            <!-- Deskripsi -->
            <div class="mb-5">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description', $product->description) }}</textarea>
                @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Favorit -->
           <div class="mb-4">
                    <label for="stock" class="block text-gray-700 font-semibold mb-1">Stock</label>
                    <input type="number" name="stock" id="stock" step="0.01" 
                            value="{{ old('stock', $product->stock) }}"
                           class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('stock') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

            <!-- Gambar -->
            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Gambar Produk</label>
                <input type="file" name="image" id="image"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                @if ($product->image)
                <div class="mt-3">
                    <p class="text-gray-600 text-sm mb-1">Gambar saat ini:</p>
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar Produk"
                        class="w-32 h-32 object-cover rounded-lg border border-gray-200">
                </div>
                @endif
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-sm transition duration-150">
                    Update Produk
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>