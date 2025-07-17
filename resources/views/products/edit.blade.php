<x-layouts.app :title="'Edit Produk'">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Edit Produk</h1>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow">
            @csrf
            @method('PUT')
            @include('products.partials.form', ['product' => $product])
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
</x-layouts.app>
