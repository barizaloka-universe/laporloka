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

    <!-- Floating Button -->
    <button id="floatingButton" class="fixed bottom-8 right-8 bg-blue-500 text-white p-4 rounded-full shadow-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
        ❓
    </button>

    <!-- Popup Modal -->
    <div id="emergencyPopup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-8 max-w-md w-full">
            <h4 class="text-2xl font-bold text-gray-800 mb-4">Nomor Penting</h4>
            <p class="text-gray-700 text-lg mb-6">Silakan hubungi <strong class="text-red-500">112</strong> untuk keadaan darurat. 🆘</p>
            <button id="closePopup" class="bg-blue-500 text-white px-6 py-3 rounded-lg text-lg hover:bg-blue-600">Tutup ✖️</button>
        </div>
    </div>

    <script>
        document.getElementById('floatingButton').addEventListener('click', function () {
            document.getElementById('emergencyPopup').classList.remove('hidden');
        });

        document.getElementById('closePopup').addEventListener('click', function () {
            document.getElementById('emergencyPopup').classList.add('hidden');
        });
    </script>
</x-layouts.home>
