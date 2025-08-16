<?php

use Livewire\Volt\Component;
use App\Enums\LaporanStatus;
use App\Enums\LaporanPrioritas;
use Illuminate\Support\Str;

new class extends Component {
    public $laporans;

    public function mount($laporans)
    {
        $this->laporans = $laporans;
    }

    public function getStatusLabel($status)
    {
        return match ($status) {
            LaporanStatus::Terkirim => 'Terkirim',
            LaporanStatus::Diterima => 'Diterima',
            LaporanStatus::Diproses => 'Diproses',
            LaporanStatus::Selesai => 'Selesai',
            LaporanStatus::Ditolak => 'Ditolak',
            LaporanStatus::ButuhInfoTambahan => 'Butuh Info Tambahan',
        };
    }

    public function getStatusClasses($status)
    {
        $baseClasses = 'px-2.5 py-1 rounded-full text-xs font-medium'; // Mengubah py-1 menjadi py-1.5 agar lebih berisi

        $statusClasses = match ($status) {
            LaporanStatus::Terkirim => 'bg-gray-100 text-gray-700 ring-1 ring-inset ring-gray-200',
            LaporanStatus::Diterima => 'bg-blue-100 text-blue-700 ring-1 ring-inset ring-blue-200',
            LaporanStatus::Diproses => 'bg-yellow-100 text-yellow-700 ring-1 ring-inset ring-yellow-200',
            LaporanStatus::Selesai => 'bg-green-100 text-green-700 ring-1 ring-inset ring-green-200',
            LaporanStatus::Ditolak => 'bg-red-100 text-red-700 ring-1 ring-inset ring-red-200',
            LaporanStatus::ButuhInfoTambahan => 'bg-purple-100 text-purple-700 ring-1 ring-inset ring-purple-200',
        };

        return $baseClasses . ' ' . $statusClasses;
    }
    
    // Metode untuk prioritas
    public function getPrioritasLabel($prioritas)
    {
        return match ($prioritas) {
            LaporanPrioritas::Rendah => 'Rendah',
            LaporanPrioritas::Sedang => 'Sedang',
            LaporanPrioritas::Tinggi => 'Tinggi',
            default => 'Tidak Diketahui',
        };
    }

    public function getPrioritasClasses($prioritas)
    {
        $baseClasses = 'px-2.5 py-1 rounded-full text-xs font-medium';
        
        $prioritasClasses = match ($prioritas) {
            LaporanPrioritas::Rendah => 'bg-green-100 text-green-700',
            LaporanPrioritas::Sedang => 'bg-yellow-100 text-yellow-700',
            LaporanPrioritas::Tinggi => 'bg-red-100 text-red-700',
            default => 'bg-gray-100 text-gray-700',
        };

        return $baseClasses . ' ' . $prioritasClasses;
    }
}; ?>

<div class="space-y-6 lg:space-y-8">
    @if ($laporans->isEmpty())
        <div class="bg-white rounded-xl shadow-md p-8 text-center border border-gray-200">
            <div class="text-gray-400 mb-4">
                <svg class="mx-auto h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M17.25 12V4.5m1.5 0H21m-2.25 18H15M4.5 9.75v10.5m0-10.5a1.5 1.5 0 01-1.5-1.5V6a2.25 2.25 0 012.25-2.25h1.372c.516 0 .966.351 1.107.855l.208.73a1.5 1.5 0 001.442 1.08h3.525a1.5 1.5 0 001.442-1.08l.208-.73c.141-.504.591-.855 1.107-.855h1.372A2.25 2.25 0 0121 6v6.75m-18 0v2.25A2.25 2.25 0 005.25 15h13.5a2.25 2.25 0 002.25-2.25V12M15 18a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <h3 class="text-gray-500 text-xl font-semibold">Belum Ada Laporan</h3>
            <p class="text-gray-400 text-sm mt-2">Laporan yang Anda kirimkan akan muncul di sini.</p>
        </div>
    @else
        @foreach ($laporans as $laporan)
            <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-200 overflow-hidden border border-gray-200">
                {{-- Header --}}
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2 lg:space-x-3 flex-wrap gap-y-2">
                            {{-- Jenis Laporan --}}
                            <span class="text-xs font-semibold text-blue-600 uppercase tracking-wider">
                                {{ $laporan->jenis_laporan }}
                            </span>
                            {{-- Status Badge --}}
                            <span class="{{ $this->getStatusClasses($laporan->status) }}">
                                {{ $this->getStatusLabel($laporan->status) }}
                            </span>
                             {{-- Prioritas Badge --}}
                            @if ($laporan->prioritas)
                                <span class="{{ $this->getPrioritasClasses($laporan->prioritas) }}">
                                    Prioritas: {{ $this->getPrioritasLabel($laporan->prioritas) }}
                                </span>
                            @endif
                        </div>
                        <span class="text-xs text-gray-500 shrink-0" title="{{ $laporan->created_at->format('d M Y, H:i') }}">
                            {{ $laporan->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>

                {{-- Content --}}
                <div class="p-6">
                    <div class="flex items-start md:space-x-6 flex-col md:flex-row">
                        {{-- Foto --}}
                        @if ($laporan->foto)
                            <div class="shrink-0 mb-4 md:mb-0">
                                <img src="{{ Storage::url($laporan->foto) }}" alt="Foto Laporan"
                                    class="rounded-md object-cover w-full h-48 md:w-48 cursor-pointer hover:opacity-95 transition-opacity duration-200"
                                    onclick="openImageModal('{{ Storage::url($laporan->foto) }}')">
                            </div>
                        @endif

                        {{-- Info Laporan --}}
                        <div class="flex-grow">
                            {{-- Judul singkat --}}
                            <h3 class="text-gray-900 text-xl font-semibold mb-2 leading-tight">
                                {{ Str::limit($laporan->judul ?? $laporan->deskripsi, 80) }}
                            </h3>

                            {{-- Deskripsi Lengkap dengan toggle --}}
                            <div x-data="{ open: false }" class="mb-4 text-gray-700 text-sm">
                                <p x-show="!open" class="mb-2">
                                    {{ Str::limit($laporan->deskripsi, 150) }}
                                    <button @click="open = true" class="text-blue-600 hover:underline focus:outline-none ml-1">
                                        Selengkapnya
                                    </button>
                                </p>
                                <p x-show="open" class="whitespace-pre-line mb-2">
                                    {{ $laporan->deskripsi }}
                                    <button @click="open = false" class="text-blue-600 hover:underline focus:outline-none ml-1">
                                        Sembunyikan
                                    </button>
                                </p>
                            </div>

                            {{-- Lokasi --}}
                            <div class="flex items-center text-gray-500 text-sm">
                                <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 6.627-5.25 12-12 12s-12-5.373-12-12 5.373-12 12-12 12 5.373 12 12z" />
                                </svg>
                                <span class="truncate">{{ $laporan->lokasi }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    {{-- Modal untuk melihat gambar --}}
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-80 hidden z-[99] flex items-center justify-center p-4 transition-opacity duration-300"
        onclick="closeImageModal()">
        <div class="relative max-w-full max-h-full" onclick="event.stopPropagation()">
            <img id="modalImage" src="" alt="Foto Laporan"
                class="max-w-full max-h-[90vh] object-contain rounded-lg shadow-xl">
            <button onclick="closeImageModal()"
                class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors text-3xl font-bold p-2">
                &times;
            </button>
        </div>
    </div>

    <script>
        function openImageModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Mencegah scrolling
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.body.style.overflow = 'auto'; // Mengaktifkan scrolling kembali
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        });
    </script>
</div>