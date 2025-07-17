<x-layouts.app :title="'Edit Produk'">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Edit Produk</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('products.partials.form', ['product' => $product])

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Update Produk
            </button>
        </form>
    </div>
</x-layouts.app>