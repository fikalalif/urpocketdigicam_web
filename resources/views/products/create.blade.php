<x-layouts.app :title="'Tambah Produk'"> <div class="container mx-auto p-4"> <h1 class="text-2xl font-bold mb-4">Tambah Produk</h1>

@if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('products.partials.form', ['product' => null])

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('products.index') }}" class="ml-2 text-gray-600 hover:text-gray-800">Batal</a>
    </form>
</div>

</x-layouts.app>