<?php

use App\Models\Laporan;

use Illuminate\Support\Facades\Request;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Str;

use Livewire\Attributes\Rule;

use Livewire\Volt\Component;

new class extends Component {
    #[Rule('required|string|max:255')]
    public string $judul_laporan = '';

    #[Rule('required|string')]
    public string $deskripsi = '';

    #[Rule('nullable|string|max:255')]
    public string $desa = '';

    #[Rule('nullable|string|max:255')]
    public string $kecamatan = '';

    #[Rule('nullable|string|max:255')]
    public string $kabupaten = '';

    #[Rule('nullable|string|max:255')]
    public string $provinsi = '';

    #[Rule('required|string|max:255')]
    public string $lokasi_detail = '';


    public function mount()
    {
        $this->laporans = Laporan::latest()->take(5)->get();
    }

    public function simpanLaporan()
    {
        $validated = $this->validate();

        $laporan = new Laporan();

        $laporan->judul_laporan = $validated['judul_laporan'];

        $laporan->deskripsi = $validated['deskripsi'];

        $laporan->desa = $validated['desa'];

        $laporan->kecamatan = $validated['kecamatan'];

        $laporan->kabupaten = $validated['kabupaten'];

        $laporan->provinsi = $validated['provinsi'];

        $laporan->lokasi_detail = $validated['lokasi_detail'];

        $laporan->save();

        // Reset field

        $this->reset(['judul_laporan', 'deskripsi', 'desa', 'kecamatan', 'kabupaten', 'provinsi', 'lokasi_detail']);

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

    <!-- Submit Button -->
    <div>
        <button type="submit"
            class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-4 px-6 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
            Kirim Laporan
        </button>
    </div>
</form>
