<x-layouts.home :title="__('Tentang Kami')">
    <main class="container mx-auto px-4 py-16">
        <div class="max-w-4xl mx-auto">
            <!-- Judul -->
            <section class="text-center mb-16 animate-fadeIn">
                <h1 class="text-4xl sm:text-5xl font-extrabold text-purple-700 mb-4 drop-shadow-lg">
                    Tentang LaporLoka
                </h1>
                <p class="text-xl text-gray-600 leading-relaxed max-w-2xl mx-auto">
                    Menghubungkan warga dengan pemerintah untuk menciptakan lingkungan yang lebih baik.
                </p>
            </section>

            <!-- Misi -->
            <section class="mb-16 animate-slideUp">
                <h2 class="text-3xl font-bold text-purple-600 text-center mb-6">Misi Kami</h2>
                <div class="bg-white rounded-2xl shadow-xl p-8 hover:shadow-purple-300 transition duration-500">
                    <p class="text-lg text-gray-700 leading-relaxed">
                        Misi LaporLoka adalah memberdayakan setiap warga untuk berpartisipasi aktif dalam memelihara dan
                        meningkatkan kualitas lingkungan tempat tinggal mereka. Kami berkomitmen untuk menyediakan
                        platform yang mudah digunakan, transparan, dan efisien agar setiap laporan dapat ditindaklanjuti
                        dengan cepat dan akurat. Kami percaya bahwa partisipasi masyarakat adalah fondasi dari
                        pemerintahan yang responsif dan efektif.
                    </p>
                </div>
            </section>

            <!-- Nilai Kami -->
            <section class="mb-16 animate-fadeIn">
                <h2 class="text-3xl font-bold text-purple-600 text-center mb-10">Nilai Kami</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                    <!-- Transparansi -->
                    <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-purple-300 transform hover:-translate-y-2 transition duration-500">
                        <div class="text-purple-500 mb-4 animate-bounce-slow">
                            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Transparansi</h3>
                        <p class="text-gray-600">Kami memastikan setiap langkah penanganan laporan dapat dipantau oleh pelapor.</p>
                    </div>
                    
                    <!-- Efisiensi -->
                    <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-purple-300 transform hover:-translate-y-2 transition duration-500">
                        <div class="text-purple-500 mb-4 animate-bounce-slow">
                            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Efisiensi</h3>
                        <p class="text-gray-600">Proses pelaporan yang cepat dan sederhana, langsung ke pihak yang tepat.</p>
                    </div>
                    
                    <!-- Kolaborasi -->
                    <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-purple-300 transform hover:-translate-y-2 transition duration-500">
                        <div class="text-purple-500 mb-4 animate-bounce-slow">
                            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 01-4-4">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Kolaborasi</h3>
                        <p class="text-gray-600">Mendorong kerja sama antara warga dan pemerintah untuk solusi bersama.</p>
                    </div>
                </div>
            </section>

            <!-- Footer Section -->
            <section class="text-center mt-16 animate-slideUp">
                <div class="bg-purple-50 rounded-2xl shadow-inner p-8">
                    <p class="text-lg text-gray-700 leading-relaxed mb-6">
                        LaporLoka dikembangkan dan dikelola oleh tim profesional
                        <span class="font-semibold text-purple-700">Barizaloka Universe</span>,
                        yang berdedikasi untuk menciptakan solusi teknologi yang inovatif untuk kemajuan masyarakat.
                    </p>
                    <a href="https://barizaloka.id/universe/apps/laporloka"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-xl transition duration-300 transform hover:scale-105 shadow-lg hover:shadow-purple-400">
                        🚀 Kunjungi Website Kami
                    </a>
                </div>
            </section>
        </div>
    </main>
</x-layouts.home>
