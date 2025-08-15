<header class="bg-blue-600 text-white shadow-lg">
    <div class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">LaporLoka - Portal Laporan Warga</h1>
            <nav class="hidden md:flex space-x-6">
                <a href="/" wire:navigate class="hover:text-blue-200 transition-colors">Beranda</a>
            </nav>

            <!-- Mobile menu button -->
            <button class="md:hidden" onclick="toggleMobileMenu()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </div>

        <!-- Mobile menu -->
        <div id="mobileMenu" class="hidden md:hidden mt-4 space-y-2">
            <a href="/" wire:navigate class="block hover:text-blue-200 transition-colors">Beranda</a>
        </div>
    </div>
</header>
<script>
    function toggleMobileMenu() {
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenu.classList.toggle('hidden');
    }
</script>
