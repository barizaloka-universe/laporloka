<x-layouts.home :title="__('LaporLoka - Akses Ditolak')">
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">403</h2>
                <p class="text-lg text-gray-700 mb-6">Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.</p>
                <a href="{{ url('/') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg text-lg hover:bg-blue-600">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </main>
</x-layouts.home>
