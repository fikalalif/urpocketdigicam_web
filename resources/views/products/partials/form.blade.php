<div class="mb-4">
    <label class="block mb-1 font-semibold">Nama Produk</label>
    <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" class="w-full border rounded px-3 py-2" required>
</div>

<div class="mb-4">
    <label class="block mb-1 font-semibold">Deskripsi</label>
    <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description', $product->description ?? '') }}</textarea>
</div>

<div class="mb-4">
    <label class="block mb-1 font-semibold">Harga</label>
    <input type="number" name="price" value="{{ old('price', $product->price ?? '') }}" class="w-full border rounded px-3 py-2" required>
</div>

<div class="mb-4">
    <label class="block mb-1 font-semibold">Stok</label>
    <input type="number" name="stock" value="{{ old('stock', $product->stock ?? '') }}" class="w-full border rounded px-3 py-2" required>
</div>

<div class="mb-4">
    <label class="block mb-1 font-semibold">SKU</label>
    <input type="text" name="sku" value="{{ old('sku', $product->sku ?? '') }}" class="w-full border rounded px-3 py-2">
</div>

<div class="mb-4">
    <label class="block mb-1 font-semibold">Berat (gram)</label>
    <input type="number" name="weight" value="{{ old('weight', $product->weight ?? '') }}" class="w-full border rounded px-3 py-2">
</div>

<div class="mb-4">
    <label class="block mb-1 font-semibold">Kategori</label>
    <select name="category_id" class="w-full border rounded px-3 py-2">
        <option value="">-- Pilih Kategori --</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @if(old('category_id', $product->category_id ?? '') == $category->id) selected @endif>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-4">
    <label class="block mb-1 font-semibold">Gambar Produk</label>
    <input type="file" name="image" class="w-full border rounded px-3 py-2">
    @if (!empty($product) && $product->image)
        <div class="mt-2">
            <img src="{{ asset('storage/' . $product->image) }}" class="w-32">
        </div>
    @endif
</div>

<div class="mb-4 flex items-center">
    <input type="checkbox" name="is_visible" id="is_visible" class="mr-2" {{ old('is_visible', $product->is_visible ?? false) ? 'checked' : '' }}>
    <label for="is_visible">Tampilkan Produk di Web Lokal</label>
</div>