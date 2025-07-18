<x-layouts.app :title="'Tambah Kategori'">
    <div class="container mx-auto px-4 py-8 animate-fade-in">
        <h1 class="text-4xl font-extrabold mb-8 text-foreground text-shadow">Tambah Kategori Baru</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6 dark:bg-red-900 dark:text-red-200 dark:border-red-700 animate-fade-in shadow-md" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-card text-card-foreground shadow-2xl rounded-xl p-8 border border-border card-gradient">
            <form action="{{ route('categories.store') }}" method="POST" class="space-y-8">
                @csrf
                @include('categories.partials.form', ['category' => null])
                <div class="flex items-center gap-4 pt-4">
                    <button type="submit" class="inline-flex items-center justify-center rounded-full text-base font-semibold transition-colors h-12 px-6 py-3 bg-primary text-primary-foreground hover:bg-primary/90 shadow-lg hover-lift">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save size-5 mr-2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2Z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Simpan Kategori
                    </button>
                    <a href="{{ route('categories.index') }}" class="inline-flex items-center justify-center rounded-full text-base font-medium transition-colors h-12 px-6 py-3 bg-muted text-muted-foreground hover:bg-muted/80 shadow-md">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
