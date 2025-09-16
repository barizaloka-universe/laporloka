<x-layouts.home :title="__('LaporLoka - Portal Laporan Warga')">
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-bold text-gray-800 text-center mb-8">Detail Laporan</h2>

            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Judul Laporan:</h3>
                <p class="text-gray-600">{{ $laporan->judul }}</p>
            </div>

            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Deskripsi:</h3>
                <p class="text-gray-600">{{ $laporan->deskripsi }}</p>
            </div>

            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Tanggal Laporan:</h3>
                <p class="text-gray-600">{{ $laporan->created_at->format('d M Y') }}</p>
            </div>

            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Status:</h3>
                <p class="text-gray-600">{{ $laporan->status }}</p>
            </div>
            </div>
        </div>
    </main>
</x-layouts.home>
