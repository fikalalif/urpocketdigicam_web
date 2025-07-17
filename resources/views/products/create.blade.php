<x-layouts.app :title="'Tambah Produk'">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Tambah Produk</h1>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow">
            @csrf
            @include('products.partials.form', ['product' => null])
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
        </form>
    </div>
</x-layouts.app>
