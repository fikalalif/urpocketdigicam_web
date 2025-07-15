<x-layouts.app :title="__('Dashboard')">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Daftar Produk</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg">
                <thead>
                    <tr>
                        <th class="py-2 px-4 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase">Nama Produk</th>
                        <th class="py-2 px-4 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase">Harga</th>
                        <th class="py-2 px-4 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase">Visibilitas Produk</th>
                        <th class="py-2 px-4 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4 border-b">{{ $product->name }}</td>
                            <td class="py-3 px-4 border-b">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="py-3 px-4 border-b">
                                @if ($product->hub_product_id)
                                    <div x-data="{
                                        isOn: {{ $product->is_visible ? 'true' : 'false' }},
                                        productId: {{ $product->id }},
                                        toggleVisibility() {
                                            console.log('Toggle visibilitas untuk ID:', this.productId);
                                            const url = `/products/${this.productId}/toggle-visibility`;
                                            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                                            fetch(url, {
                                                method: 'PUT',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'Accept': 'application/json',
                                                    'X-CSRF-TOKEN': csrfToken,
                                                },
                                                body: JSON.stringify({ is_on: this.isOn })
                                            })
                                            .then(response => {
                                                if (!response.ok) {
                                                    return response.json().then(err => { throw new Error(err.message); });
                                                }
                                                return response.json();
                                            })
                                            .then(data => {
                                                alert(data.message);
                                            })
                                            .catch(error => {
                                                alert('Gagal update visibilitas: ' + error.message);
                                                this.isOn = !this.isOn;
                                            });
                                        }
                                    }">
                                        <button type="button"
                                            x-on:click="isOn = !isOn; toggleVisibility()"
                                            :aria-checked="isOn"
                                            :class="isOn ? 'bg-indigo-600' : 'bg-gray-200'"
                                            class="relative inline-flex h-6 w-11 rounded-full border-2 transition-colors duration-200 ease-in-out">
                                            <span
                                                :class="isOn ? 'translate-x-5' : 'translate-x-0'"
                                                class="inline-block h-5 w-5 transform bg-white rounded-full transition duration-200 ease-in-out">
                                            </span>
                                        </button>
                                    </div>
                                @else
                                    <span class="text-red-500">Belum Disinkronkan</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 border-b">
                                @if (!$product->hub_product_id)
                                    <button
                                        x-data="{ productId: '{{ $product->id }}' }"
                                        x-on:click="
                                            console.log('Klik sync product', productId);
                                            const url = `/products/${productId}/sync-to-hub`;
                                            const csrfToken = document.querySelector('meta[name=\'csrf-token\']').getAttribute('content');

                                            fetch(url, {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'Accept': 'application/json',
                                                    'X-CSRF-TOKEN': csrfToken,
                                                },
                                                body: JSON.stringify({})
                                            })
                                            .then(response => response.json())
                                            .then(data => {
                                                alert(data.message + '\nHub Product ID: ' + data.hub_product_id);
                                                location.reload();
                                            })
                                            .catch(error => {
                                                alert('Gagal sinkronisasi: ' + error.message);
                                            });
                                        "
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">
                                        Sinkronkan ke Hub
                                    </button>
                                @else
                                    <button
                                        x-data="{ productId: {{ $product->id }} }"
                                        x-on:click="
                                            if (!confirm('Yakin ingin menghapus dari Hub?')) return;
                                            const url = `/products/${productId}/delete-from-hub`;
                                            const csrfToken = document.querySelector('meta[name=\'csrf-token\']').getAttribute('content');

                                            fetch(url, {
                                                method: 'DELETE',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'Accept': 'application/json',
                                                    'X-CSRF-TOKEN': csrfToken,
                                                }
                                            })
                                            .then(response => response.json())
                                            .then(data => {
                                                alert(data.message);
                                                location.reload();
                                            })
                                            .catch(error => {
                                                alert('Gagal hapus produk: ' + error.message);
                                            });
                                        "
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded text-sm">
                                        Hapus dari Hub
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
