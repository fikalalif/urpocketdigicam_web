<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="space-y-4">
        <div>
            <label for="name" class="block text-sm font-medium text-foreground mb-1">Nama Produk</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name ?? '') }}"
                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none input-focus-glow disabled:cursor-not-allowed disabled:opacity-50" required>
        </div>
        <div>
            <label for="description" class="block text-sm font-medium text-foreground mb-1">Deskripsi</label>
            <textarea name="description" id="description" rows="4"
                class="flex min-h-[100px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none input-focus-glow disabled:cursor-not-allowed disabled:opacity-50">{{ old('description', $product->description ?? '') }}</textarea>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="price" class="block text-sm font-medium text-foreground mb-1">Harga (Rp)</label>
                <input type="number" name="price" id="price" value="{{ old('price', $product->price ?? '') }}"
                    class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none input-focus-glow disabled:cursor-not-allowed disabled:opacity-50" step="0.01" required>
            </div>
            <div>
                <label for="stock" class="block text-sm font-medium text-foreground mb-1">Stok</label>
                <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock ?? '') }}"
                    class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none input-focus-glow disabled:cursor-not-allowed disabled:opacity-50" required>
            </div>
        </div>
    </div>

    <div class="space-y-4">
        <div>
            <label for="sku" class="block text-sm font-medium text-foreground mb-1">SKU</label>
            <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku ?? '') }}"
                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none input-focus-glow disabled:cursor-not-allowed disabled:opacity-50">
        </div>
        <div>
            <label for="weight" class="block text-sm font-medium text-foreground mb-1">Berat (gram)</label>
            <input type="number" name="weight" id="weight" value="{{ old('weight', $product->weight ?? '') }}"
                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none input-focus-glow disabled:cursor-not-allowed disabled:opacity-50">
        </div>
        <div>
            <label for="category_id" class="block text-sm font-medium text-foreground mb-1">Kategori</label>
            <select name="category_id" id="category_id"
                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background focus-visible:outline-none input-focus-glow disabled:cursor-not-allowed disabled:opacity-50">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if(old('category_id', $product->category_id ?? '') == $category->id) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="image" class="block text-sm font-medium text-foreground mb-1">Gambar Produk</label>
            <input type="file" name="image" id="image"
                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none input-focus-glow disabled:cursor-not-allowed disabled:opacity-50">
            @if (!empty($product) && $product->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="w-32 h-32 object-cover rounded-md border border-border shadow-sm">
                </div>
            @endif
        </div>
        <div class="flex items-center mt-4">
            <input type="checkbox" name="is_visible" id="is_visible" class="h-4 w-4 text-primary rounded border-gray-300 focus:ring-primary mr-2" {{ old('is_visible', $product->is_visible ?? false) ? 'checked' : '' }}>
            <label for="is_visible" class="text-sm font-medium text-foreground">Tampilkan Produk di Web Lokal</label>
        </div>
    </div>
</div>
