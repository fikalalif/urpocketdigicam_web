<div class="grid grid-cols-1 md:grid-cols-2 gap-6" x-data="{ type: '{{ old('type', $product->type ?? 'sale') }}' }">
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
        
        <div>
            <label for="type" class="block text-sm font-medium text-foreground mb-1">Tipe Produk</label>
            <select name="type" id="type" x-model="type"
                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background focus-visible:outline-none input-focus-glow disabled:cursor-not-allowed disabled:opacity-50">
                <option value="sale">Hanya Jual</option>
                <option value="rental">Hanya Sewa</option>
                <option value="both">Jual & Sewa</option>
            </select>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div x-show="type === 'sale' || type === 'both'">
                <label for="price" class="block text-sm font-medium text-foreground mb-1">Harga Jual (Rp)</label>
                <input type="number" name="price" id="price" value="{{ old('price', $product->price ?? '') }}"
                    class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none input-focus-glow disabled:cursor-not-allowed disabled:opacity-50" step="0.01">
            </div>
            <div x-show="type === 'rental' || type === 'both'">
                <label for="rental_price" class="block text-sm font-medium text-foreground mb-1">Harga Sewa / Hari (Rp)</label>
                <input type="number" name="rental_price" id="rental_price" value="{{ old('rental_price', $product->rental_price ?? '') }}"
                    class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none input-focus-glow disabled:cursor-not-allowed disabled:opacity-50" step="0.01">
            </div>
        </div>
    </div>

    <div class="space-y-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="stock" class="block text-sm font-medium text-foreground mb-1">Stok</label>
                <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock ?? '0') }}"
                    class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none input-focus-glow disabled:cursor-not-allowed disabled:opacity-50" required>
            </div>
            <div>
                <label for="sku" class="block text-sm font-medium text-foreground mb-1">SKU</label>
                <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku ?? '') }}"
                    class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none input-focus-glow disabled:cursor-not-allowed disabled:opacity-50">
            </div>
        </div>
        <div>
            <label for="weight" class="block text-sm font-medium text-foreground mb-1">Berat (gram)</label>
            <input type="number" name="weight" id="weight" value="{{ old('weight', $product->weight ?? '0') }}"
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
                    <img src="{{ $product->image_url }}" alt="Product Image" class="w-32 h-32 object-cover rounded-md border border-border shadow-sm">
                </div>
            @endif
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
            <div class="flex items-center">
                <input type="checkbox" name="is_visible" id="is_visible" value="1" class="h-4 w-4 text-primary rounded border-gray-300 focus:ring-primary mr-2" {{ old('is_visible', $product->is_visible ?? true) ? 'checked' : '' }}>
                <label for="is_visible" class="text-sm font-medium text-foreground">Tampilkan di Katalog</label>
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="is_available" id="is_available" value="1" class="h-4 w-4 text-primary rounded border-gray-300 focus:ring-primary mr-2" {{ old('is_available', $product->is_available ?? true) ? 'checked' : '' }}>
                <label for="is_available" class="text-sm font-medium text-foreground">Tersedia untuk Sewa</label>
            </div>
        </div>
    </div>
</div>
