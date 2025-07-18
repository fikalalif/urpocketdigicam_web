<div class="space-y-6">
    <div>
        <label for="name" class="block text-sm font-medium text-foreground mb-1">Nama Kategori</label>
        <input type="text" name="name" id="name" value="{{ old('name', $category->name ?? '') }}"
            class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none input-focus-glow disabled:cursor-not-allowed disabled:opacity-50" required>
    </div>
    <div>
        <label for="description" class="block text-sm font-medium text-foreground mb-1">Deskripsi</label>
        <textarea name="description" id="description" rows="4"
            class="flex min-h-[100px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none input-focus-glow disabled:cursor-not-allowed disabled:opacity-50">{{ old('description', $category->description ?? '') }}</textarea>
    </div>
    <div class="flex items-center">
        <input type="checkbox" name="is_visible" id="is_visible" value="1" class="h-4 w-4 text-primary rounded border-gray-300 focus:ring-primary mr-2"
            {{ old('is_visible', $category->is_visible ?? true) ? 'checked' : '' }}>
        <label for="is_visible" class="text-sm font-medium text-foreground">Tampilkan di Website Lokal</label>
    </div>
</div>
