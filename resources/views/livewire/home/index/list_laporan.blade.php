<?php

use Livewire\Volt\Component;
use App\Enums\LaporanStatus;
use App\Enums\LaporanPrioritas;
use Illuminate\Support\Str;
use App\Models\Laporan;
use Livewire\Attributes\On;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public $selectedStatus = '';
    public $selectedPrioritas = '';

    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        $this->js(
            <<<JS
                const cachedStatus = localStorage.getItem('selectedStatus');
                const cachedPrioritas = localStorage.getItem('selectedPrioritas');

                if (cachedStatus) \$wire.set('selectedStatus', cachedStatus);
                if (cachedPrioritas) \$wire.set('selectedPrioritas', cachedPrioritas);
            JS
            ,
        );
    }

    public function updatedSelectedStatus($value)
    {
        $this->resetPage();
        $this->cacheFilter('selectedStatus', $value);
    }

    public function updatedSelectedPrioritas($value)
    {
        $this->resetPage();
        $this->cacheFilter('selectedPrioritas', $value);
    }

    private function cacheFilter($key, $value)
    {
        if ($value && $value !== '') {
            $this->js("localStorage.setItem('{$key}', '{$value}');");
        } else {
            $this->js("localStorage.removeItem('{$key}');");
        }
    }

    public function getLaporansProperty()
    {
        $query = Laporan::query();

        if ($this->selectedStatus) {
            $query->where('status', $this->selectedStatus);
        }

        if ($this->selectedPrioritas) {
            $query->where('prioritas', $this->selectedPrioritas);
        }

        return $query->orderBy('created_at', 'desc')->paginate(7);
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

    {{-- Loading State --}}
    <div wire:loading wire:target="selectedStatus,selectedPrioritas"
        class="bg-white rounded-xl shadow-md p-8 text-center border border-gray-200">
        <div class="text-gray-400 mb-4">
            <svg class="animate-spin mx-auto h-8 w-8" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
        </div>
        <p class="text-gray-500">Memuat laporan...</p>
    </div>

    {{-- Filter Tambahan --}}
    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-200 space-y-4">
        <div>
            <label for="status-select" class="block text-sm font-medium text-gray-700 mb-2">Filter Status</label>
            <select id="status-select" wire:model.live="selectedStatus"
                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 sm:text-sm rounded-md">
                <option value="">-- Semua Status --</option>
                @foreach (App\Enums\LaporanStatus::cases() as $status)
                    <option value="{{ $status->value }}">{{ $this->getStatusLabel($status) }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="prioritas-select" class="block text-sm font-medium text-gray-700 mb-2">Filter Prioritas</label>
            <select id="prioritas-select" wire:model.live="selectedPrioritas"
                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 sm:text-sm rounded-md">
                <option value="">-- Semua Prioritas --</option>
                @foreach (App\Enums\LaporanPrioritas::cases() as $prioritas)
                    <option value="{{ $prioritas->value }}">{{ $this->getPrioritasLabel($prioritas) }}</option>
                @endforeach
            </select>
        </div>
    </div>

    @if ($this->laporans->isEmpty())
        <div class="bg-white rounded-xl shadow-md p-8 text-center border border-gray-200">
            <div class="text-gray-400 mb-4">
                <svg class="mx-auto h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25">
                    </path>
                </svg>
            </div>
            <h3 class="text-gray-500 text-xl font-semibold">Belum Ada Laporan</h3>
            <p class="text-gray-400 text-sm mt-2">
                Belum ada laporan yang dikirim.
            </p>
        </div>
    @else
        <div wire:loading.remove wire:target="selectedStatus,selectedPrioritas">
            @foreach ($this->laporans as $laporan)
                <div
                    class="bg-white rounded-xl my-2 shadow-md hover:shadow-lg transition-shadow duration-200 overflow-hidden border border-gray-200">
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
                            <span class="text-xs text-gray-500 shrink-0"
                                title="{{ $laporan->created_at->format('d M Y, H:i') }}">
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
                                        @if (strlen($laporan->deskripsi) > 150)
                                            <button @click="open = true"
                                                class="text-blue-600 hover:underline focus:outline-none ml-1">
                                                Selengkapnya
                                            </button>
                                        @endif
                                    </p>
                                    <div x-show="open" class="mb-2">
                                        <p class="whitespace-pre-line">{{ $laporan->deskripsi }}</p>
                                        <button @click="open = false"
                                            class="text-blue-600 hover:underline focus:outline-none mt-1">
                                            Sembunyikan
                                        </button>
                                    </div>
                                </div>

                                {{-- Lokasi --}}
                                <div class="flex items-center text-gray-500 text-sm">
                                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 10.5c0 6.627-5.25 12-12 12s-12-5.373-12-12 5.373-12 12-12 12 5.373 12 12z" />
                                    </svg>
                                    <span class="truncate">{{ Str::limit($laporan->lokasi_detail, 40) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $this->laporans->links() }}
            </div>
        </div>
    @endif
</div>
