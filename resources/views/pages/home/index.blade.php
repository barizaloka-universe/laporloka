<x-layouts.home :title="__('LaporLoka - Portal Laporan Warga')">
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow-md p-8">
                <h2 class="text-2xl font-bold text-gray-800 text-center mb-8">Sampaikan Laporan Anda</h2>

                <form action="" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label for="judul_laporan" class="block text-sm font-medium text-gray-700 mb-2">
                            Judul Laporan
                        </label>
                        <input type="text" id="judul_laporan" name="judul_laporan"
                            placeholder="Contoh: Lampu Jalan Mati di Gang Mawar" value="{{ old('judul_laporan') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                            required>
                        @error('judul_laporan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi
                        </label>
                        <textarea id="deskripsi" name="deskripsi" rows="5" placeholder="Jelaskan masalah yang terjadi secara rinci..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"
                            required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="desa" class="block text-sm font-medium text-gray-700 mb-2">
                                Desa / Kelurahan
                            </label>
                            <input type="text" id="desa" name="desa" placeholder="Cth: Desa Tegalrejo"
                                value="{{ old('desa') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            @error('desa')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="kecamatan" class="block text-sm font-medium text-gray-700 mb-2">
                                Kecamatan
                            </label>
                            <input type="text" id="kecamatan" name="kecamatan" placeholder="Cth: Kecamatan Jatisari"
                                value="{{ old('kecamatan') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            @error('kecamatan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="kabupaten" class="block text-sm font-medium text-gray-700 mb-2">
                                Kabupaten / Kota
                            </label>
                            <input type="text" id="kabupaten" name="kabupaten" placeholder="Cth: Kabupaten Klaten"
                                value="{{ old('kabupaten') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            @error('kabupaten')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-2">
                                Provinsi
                            </label>
                            <input type="text" id="provinsi" name="provinsi" placeholder="Cth: Jawa Tengah"
                                value="{{ old('provinsi') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            @error('provinsi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div>
                        <label for="lokasi_detail" class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat Detail
                        </label>
                        <input type="text" id="lokasi_detail" name="lokasi_detail"
                            placeholder="Cth: Jl. Sudirman No. 123" value="{{ old('lokasi_detail') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                            required>
                        @error('lokasi_detail')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-4 px-6 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                            Kirim Laporan
                        </button>
                    </div>
                </form>
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
