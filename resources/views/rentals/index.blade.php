<x-layouts.app :title="__('Rentals')">
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Daftar Rental</h1>
            <a href="{{ route('rentals.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 transition">
                + Catat Rental Baru
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-800 overflow-hidden shadow-sm">
            <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-800">
                <thead class="bg-zinc-50 dark:bg-zinc-800/50">
                    <tr>
                        <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider">Produk</th>
                        <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider">Customer</th>
                        <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider">Durasi</th>
                        <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider">Total Harga</th>
                        <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider">Status</th>
                        <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                    @forelse($rentals as $rental)
                        <tr>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="font-medium">{{ $rental->product->name }}</div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="font-medium">{{ $rental->customer_name }}</div>
                                <div class="text-xs text-zinc-500">{{ $rental->customer_phone }}</div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm">
                                {{ $rental->start_date->format('d M') }} - {{ $rental->end_date->format('d M Y') }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                Rp{{ number_format($rental->total_price, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <form action="{{ route('rentals.updateStatus', $rental->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="text-xs rounded border-zinc-300 dark:bg-zinc-800">
                                        <option value="pending" {{ $rental->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="ongoing" {{ $rental->status == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                        <option value="completed" {{ $rental->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ $rental->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </form>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm">
                                <form action="{{ route('rentals.destroy', $rental->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus data rental ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-zinc-500">Belum ada data rental.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $rentals->links() }}
        </div>
    </div>
</x-layouts.app>
