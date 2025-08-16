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
            @if ($laporans->isEmpty())
                <p class="text-gray-500 text-center">Belum ada laporan yang terkirim.</p>
            @else
                <div class="space-y-6">
                    @foreach ($laporans as $laporan)
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-semibold text-blue-600 uppercase tracking-wide">
                                    {{ $laporan->jenis_laporan }}
                                </span>
                                <span class="text-xs text-gray-500">
                                    {{ $laporan->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <p class="text-gray-800 text-lg font-medium">
                                {{ Str::limit($laporan->deskripsi, 100) }}
                            </p>
                            <p class="text-gray-600 text-sm mt-1">
                                Lokasi: {{ $laporan->lokasi }}
                            </p>
                            @if ($laporan->foto)
                                <img src="{{ asset('storage/' . $laporan->foto) }}"
                                    alt="Foto Laporan" class="mt-4 rounded-md object-cover h-48 w-full">
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </main>
    <script>
        // Auto-resize textarea
        document.getElementById('deskripsi').addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });

        // Form validation feedback
        document.querySelector('form').addEventListener('submit', function(e) {
            const button = this.querySelector('button[type="submit"]');
            button.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Mengirim Laporan...
            `;
            button.disabled = true;
        });
    </script>
</x-layouts.home>
