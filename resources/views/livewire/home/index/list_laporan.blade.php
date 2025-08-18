<?php

use Livewire\Volt\Component;
use App\Enums\LaporanStatus;
use App\Enums\LaporanPrioritas;
use Illuminate\Support\Str;
use App\Models\Laporan;
use App\Models\Desa;
use Livewire\Attributes\On; 

new class extends Component {
    public $laporans;
    public $desas;
    public $selectedDesa = '';

    public function mount()
    {
        // Ambil semua data desa dari model Desa
        $this->desas = Desa::all();
        // Awalnya, tampilkan koleksi laporan kosong
        $this->laporans = collect(); 

        // Livewire v3: Jalankan JavaScript saat komponen dimuat
        // Memuat nilai dari cache browser (localStorage)
        $this->js(<<<JS
            const cachedDesa = localStorage.getItem('selectedDesa');
            if (cachedDesa) {
                // Set properti Livewire dengan nilai dari cache
                \$wire.set('selectedDesa', cachedDesa);
            }
        JS);
    }

    public function updatedSelectedDesa($value)
    {
        // Simpan nilai desa yang dipilih ke cache browser (localStorage)
        // Ini akan dieksekusi setiap kali nilai selectedDesa berubah
        if ($value && $value !== '') {
            $this->js("localStorage.setItem('selectedDesa', '{$value}');");
            $this->laporans = Laporan::where('desa_id', $value)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            // Jika tidak ada desa yang dipilih, hapus dari cache
            $this->js("localStorage.removeItem('selectedDesa');");
            $this->laporans = collect();
        }
    }

    public function getStatusLabel($status)
    {
        return match ($status) {
            LaporanStatus::Terkirim => 'Terkirim',
            LaporanStatus::Duplikat => 'Duplikat',
            LaporanStatus::Diproses => 'Diproses',
            LaporanStatus::Selesai => 'Selesai',
            LaporanStatus::Ditolak => 'Ditolak',
            LaporanStatus::ButuhInfoTambahan => 'Butuh Info Tambahan',
        };
    }

    public function getStatusClasses($status)
    {
        $baseClasses = 'px-2.5 py-1 rounded-full text-xs font-medium';

        $statusClasses = match ($status) {
            LaporanStatus::Terkirim => 'bg-gray-100 text-gray-700 ring-1 ring-inset ring-gray-200',
            LaporanStatus::Duplikat => 'bg-blue-100 text-blue-700 ring-1 ring-inset ring-blue-200',
            LaporanStatus::Diproses => 'bg-yellow-100 text-yellow-700 ring-1 ring-inset ring-yellow-200',
            LaporanStatus::Selesai => 'bg-green-100 text-green-700 ring-1 ring-inset ring-green-200',
            LaporanStatus::Ditolak => 'bg-red-100 text-red-700 ring-1 ring-inset ring-red-200',
            LaporanStatus::ButuhInfoTambahan => 'bg-purple-100 text-purple-700 ring-1 ring-inset ring-purple-200',
        };

        return $baseClasses . ' ' . $statusClasses;
    }
    
    public function getPrioritasLabel($prioritas)
    {
        return match ($prioritas) {
            LaporanPrioritas::Rendah => 'Rendah',
            LaporanPrioritas::Sedang => 'Sedang',
            LaporanPrioritas::Tinggi => 'Tinggi',
            LaporanPrioritas::Darurat => 'Darurat',
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
            LaporanPrioritas::Darurat => 'bg-orange-100 text-orange-700',
            default => 'bg-gray-100 text-gray-700',
        };

        return $baseClasses . ' ' . $prioritasClasses;
    }
}; ?>

<div class="space-y-6 lg:space-y-8">

    {{-- Dropdown untuk Memilih Desa --}}
    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-200">
        <label for="desa-select" class="block text-sm font-medium text-gray-700 mb-2">Pilih Desa untuk melihat laporan</label>
        <select id="desa-select"
            wire:model.live="selectedDesa"
            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
            <option value="">-- Pilih Desa --</option>
            @foreach ($desas as $desa)
                <option value="{{ $desa->kode_desa }}">{{ $desa->nama_desa }}</option>
            @endforeach
        </select>
    </div>

    {{-- Loading State --}}
    <div wire:loading wire:target="selectedDesa" class="bg-white rounded-xl shadow-md p-8 text-center border border-gray-200">
        <div class="text-gray-400 mb-4">
            <svg class="animate-spin mx-auto h-8 w-8" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
        <p class="text-gray-500">Memuat laporan...</p>
    </div>

    @if ($laporans->isEmpty() && !$selectedDesa)
        <div class="bg-white rounded-xl shadow-md p-8 text-center border border-gray-200">
            <div class="text-gray-400 mb-4">
                <svg class="mx-auto h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M17.25 12V4.5m1.5 0H21m-2.25 18H15M4.5 9.75v10.5m0-10.5a1.5 1.5 0 01-1.5-1.5V6a2.25 2.25 0 012.25-2.25h1.372c.516 0 .966.351 1.107.855l.208.73a1.5 1.5 0 001.442 1.08h3.525a1.5 1.5 0 001.442-1.08l.208-.73c.141-.504.591-.855 1.107-.855h1.372A2.25 2.25 0 0121 6v6.75m-18 0v2.25A2.25 2.25 0 005.25 15h13.5a2.25 2.25 0 002.25-2.25V12M15 18a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <h3 class="text-gray-500 text-xl font-semibold">Pilih Desa</h3>
            <p class="text-gray-400 text-sm mt-2">
                Silakan pilih desa untuk menampilkan laporan.
            </p>
        </div>
    @elseif ($laporans->isEmpty() && $selectedDesa)
        <div class="bg-white rounded-xl shadow-md p-8 text-center border border-gray-200">
            <div class="text-gray-400 mb-4">
                <svg class="mx-auto h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M17.25 12V4.5m1.5 0H21m-2.25 18H15M4.5 9.75v10.5m0-10.5a1.5 1.5 0 01-1.5-1.5V6a2.25 2.25 0 012.25-2.25h1.372c.516 0 .966.351 1.107.855l.208.73a1.5 1.5 0 001.442 1.08h3.525a1.5 1.5 0 001.442-1.08l.208-.73c.141-.504.591-.855 1.107-.855h1.372A2.25 2.25 0 0121 6v6.75m-18 0v2.25A2.25 2.25 0 005.25 15h13.5a2.25 2.25 0 002.25-2.25V12M15 18a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <h3 class="text-gray-500 text-xl font-semibold">Belum Ada Laporan</h3>
            <p class="text-gray-400 text-sm mt-2">
                Belum ada laporan yang dikirim untuk desa ini.
            </p>
        </div>
    @else
        <div wire:loading.remove wire:target="selectedDesa">
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
                            {{-- Info Laporan --}}
                            <div class="flex-grow">
                                {{-- Judul singkat --}}
                                <h3 class="text-gray-900 text-xl font-semibold mb-2 leading-tight">
                                    {{ Str::limit($laporan->judul_laporan, 40) }}
                                </h3>

                                {{-- Deskripsi Lengkap dengan toggle --}}
                                <div x-data="{ open: false }" class="mb-4 text-gray-700 text-sm">
                                    <p x-show="!open" class="mb-2">
                                        {{ Str::limit($laporan->deskripsi, 150) }}
                                        @if(strlen($laporan->deskripsi) > 150)
                                            <button @click="open = true" class="text-blue-600 hover:underline focus:outline-none ml-1">
                                                Selengkapnya
                                            </button>
                                        @endif
                                    </p>
                                    <div x-show="open" class="mb-2">
                                        <p class="whitespace-pre-line">{{ $laporan->deskripsi }}</p>
                                        <button @click="open = false" class="text-blue-600 hover:underline focus:outline-none mt-1">
                                            Sembunyikan
                                        </button>
                                    </div>
                                </div>

                                {{-- Lokasi --}}
                                <div class="flex items-center text-gray-500 text-sm">
                                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 6.627-5.25 12-12 12s-12-5.373-12-12 5.373-12 12-12 12 5.373 12 12z" />
                                    </svg>
                                    <span class="truncate">{{ Str::limit($laporan->lokasi_detail, 40) }}</span>
                                </div>

                                {{-- Info Desa --}}
                                <div class="flex items-center text-gray-500 text-sm mt-2">
                                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                    </svg>
                                    <span class="truncate">Desa {{ $laporan->desa->nama_desa ?? 'Tidak Diketahui' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
