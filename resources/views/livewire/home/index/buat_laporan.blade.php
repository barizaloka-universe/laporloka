<?php

use App\Models\Laporan;
use App\Models\Desa; // Impor model Desa
use App\Enums\LaporanPrioritas; // Impor enum LaporanPrioritas
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    #[Rule('required|string|max:255')]
    public string $judul_laporan = '';

    #[Rule('required|string')]
    public string $deskripsi = '';

    // Mengubah properti menjadi desa_id agar sesuai dengan kolom di database
    #[Rule('required|string|max:255')]
    public string $desa_id = '';

    #[Rule('required|string|max:255')]
    public string $lokasi_detail = '';

    // Tambahan untuk prioritas
    #[Rule('required|string|in:rendah,sedang,tinggi,darurat')]
    public string $prioritas = '';

    // Properti untuk menyimpan daftar desa
    public $desas = [];

    public function mount()
    {
        $this->laporans = Laporan::latest()->take(5)->get();

        // Mengambil semua data dari model Desa
        $this->desas = Desa::all();
    }

    public function simpanLaporan()
    {
        $validated = $this->validate();

        $laporan = new Laporan();

        $laporan->judul_laporan = $validated['judul_laporan'];
        $laporan->deskripsi = $validated['deskripsi'];
        
        // Menggunakan desa_id, bukan desa
        $laporan->desa_id = $validated['desa_id'];
        
        $laporan->lokasi_detail = $validated['lokasi_detail'];
        
        // Menyimpan prioritas menggunakan enum
        $laporan->prioritas = LaporanPrioritas::from($validated['prioritas']);

        $laporan->save();

        // Reset field
        $this->reset(['judul_laporan', 'deskripsi', 'desa_id', 'lokasi_detail', 'prioritas']);

        // Refresh data
        $this->mount();

        Session::flash('message', 'Laporan Anda berhasil dikirim!');
    }

    public function with()
    {
        return [
            'Str' => new Str(),
        ];
    }
}; ?>

<form wire:submit="simpanLaporan" class="space-y-6">
    @csrf

    <!-- Judul Laporan -->
    <div>
        <label for="judul_laporan" class="block text-sm font-medium text-gray-700 mb-2">
            Judul Laporan
        </label>
        <input type="text" id="judul_laporan" name="judul_laporan" wire:model="judul_laporan"
            placeholder="Contoh: Lampu Jalan Mati di Gang Mawar"
            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
            required>
        @error('judul_laporan')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Deskripsi -->
    <div>
        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
            Deskripsi
        </label>
        <textarea id="deskripsi" name="deskripsi" wire:model="deskripsi" rows="5"
            placeholder="Jelaskan masalah yang terjadi secara rinci..."
            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"
            required></textarea>
        @error('deskripsi')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Dropdown Desa -->
    <div>
        <label for="desa_id" class="block text-sm font-medium text-gray-700 mb-2">
            Pilih Desa
        </label>
        <select id="desa_id" name="desa_id" wire:model="desa_id"
            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
            required>
            <option value="">-- Pilih Desa --</option>
            @foreach($desas as $desa)
                <option value="{{ $desa->kode_desa }}">{{ $desa->nama_desa }}</option>
            @endforeach
        </select>
        @error('desa_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Lokasi Detail -->
    <div>
        <label for="lokasi_detail" class="block text-sm font-medium text-gray-700 mb-2">
            Lokasi Detail
        </label>
        <input type="text" id="lokasi_detail" name="lokasi_detail" wire:model="lokasi_detail"
            placeholder="Contoh: Dekat Pos Ronda RT 02 RW 03"
            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
            required>
        @error('lokasi_detail')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Prioritas -->
    <div>
        <label for="prioritas" class="block text-sm font-medium text-gray-700 mb-2">
            Prioritas Laporan
        </label>
        <select id="prioritas" name="prioritas" wire:model="prioritas"
            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
            required>
            <option value="">-- Pilih Prioritas --</option>
            <option value="rendah" class="text-green-600">Rendah - Tidak mendesak</option>
            <option value="sedang" class="text-yellow-600">Sedang - Perlu perhatian</option>
            <option value="tinggi" class="text-orange-600">Tinggi - Segera ditangani</option>
            <option value="darurat" class="text-red-600">Darurat - Butuh tindakan cepat</option>
        </select>
        @error('prioritas')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Submit Button -->
    <div>
        <button type="submit"
            class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-4 px-6 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
            Kirim Laporan
        </button>
    </div>
</form>