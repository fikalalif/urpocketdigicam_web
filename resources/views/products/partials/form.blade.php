<div class="mb-4">
    <label class="block font-bold mb-1">Nama Produk</label>
    <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" class="w-full border rounded px-3 py-2" required>
    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
</div>

<div class="mb-4">
    <label class="block font-bold mb-1">Deskripsi</label>
    <textarea name="description" rows="3" class="w-full border rounded px-3 py-2">{{ old('description', $product->description ?? '') }}</textarea>
    @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
</div>

<div class="mb-4">
    <label class="block font-bold mb-1">Harga</label>
    <input type="number" name="price" value="{{ old('price', $product->price ?? '') }}" class="w-full border rounded px-3 py-2" required>
    @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
</div>

<div class="mb-4">
    <label class="block font-bold mb-1">Stok</label>
    <input type="number" name="stock" value="{{ old('stock', $product->stock ?? '') }}" class="w-full border rounded px-3 py-2" required>
    @error('stock') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
</div>

<div class="mb-4">
    <label class="block font-bold mb-1">SKU</label>
    <input type="text" name="sku" value="{{ old('sku', $product->sku ?? '') }}" class="w-full border rounded px-3 py-2">
    @error('sku') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
</div>

<div class="mb-4">
    <label class="block font-bold mb-1">Berat (gr)</label>
    <input type="number" name="weight" value="{{ old('weight', $product->weight ?? '') }}" class="w-full border rounded px-3 py-2">
    @error('weight') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
</div>

<div class="mb-4">
    <label class="block font-bold mb-1">Kategori</label>
    <select name="category_id" class="w-full border rounded px-3 py-2">
        <option value="">-- Pilih Kategori --</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
</div>

<div class="mb-4">
    <label class="block font-bold mb-1">Gambar</label>
    <input type="file" name="image" class="w-full border rounded px-3 py-2">
    @if (isset($product) && $product->image)
        <img src="{{ asset('storage/' . $product->image) }}" alt="Produk" class="w-24 mt-2">
    @endif
    @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
</div>

<div class="mb-4">
    <label class="inline-flex items-center">
        <input type="checkbox" name="is_active" class="form-checkbox" {{ old('is_active', $product->is_active ?? false) ? 'checked' : '' }}>
        <span class="ml-2">Aktif</span>
    </label>
</div>
