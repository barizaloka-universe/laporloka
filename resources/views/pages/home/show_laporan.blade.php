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

            <div class="bg-white rounded-lg shadow-md p-8 mt-8">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Diskusi dan Komentar Warga</h3>
                <div class="space-y-4">
                    @foreach ($laporan->threads as $thread)
                        <div class="border-b pb-4">
                            <p class="text-sm text-gray-500">{{ $thread->user->name ?? 'Anonimus' }} - {{ $thread->created_at->diffForHumans() }}</p>
                            <p class="text-gray-700">{{ $thread->content }}</p>
                        </div>
                    @endforeach
                </div>

                <form action="{{ route('threads.store', $laporan) }}" method="POST" class="mt-6 bg-gray-50 p-4 rounded-lg shadow-md">
                    @csrf
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Tulis Komentar</label>
                    <textarea 
                        name="content" 
                        id="content" 
                        rows="4" 
                        class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500 p-3 text-gray-700" 
                        placeholder="Tulis komentar..."></textarea>
                    <button 
                        type="submit" 
                        class="mt-4 w-full px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition duration-200">
                        Kirim
                    </button>
                </form>
            </div>
        </div>
    </main>
</x-layouts.home>
