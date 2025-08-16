<x-layouts.home :title="__('LaporLoka - Portal Laporan Warga')">
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow-md p-8">
                <h2 class="text-2xl font-bold text-gray-800 text-center mb-8">Sampaikan Laporan Anda</h2>

                @livewire('home/index/buat_laporan')
            </div>
        </div>

        <div class="mt-12 max-w-2xl mx-auto">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Laporan Terbaru</h3>
            @livewire('home/index/list_laporan')
        </div>
    </main>
</x-layouts.home>
