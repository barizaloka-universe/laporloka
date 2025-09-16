<header class="bg-gradient-to-r from-purple-700 to-purple-900 text-white shadow-lg">
    <div class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            <a href="/" class="text-2xl font-bold tracking-wide animate-fade-in">
                🌌 Portal Laporan Warga
            </a>

            <!-- Desktop Nav -->
            <nav class="hidden md:flex space-x-6">
                <a href="{{ route('about') }}" wire:navigate
                    class="relative hover:text-purple-200 transition-colors duration-300 after:content-[''] after:absolute after:-bottom-1 after:left-0 after:w-0 after:h-[2px] after:bg-purple-300 hover:after:w-full after:transition-all">
                    Tentang
                </a>
            </nav>

            <!-- Mobile menu button -->
            <button class="md:hidden focus:outline-none transform transition-transform hover:scale-110"
                onclick="toggleMobileMenu()">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Mobile menu -->
        <div id="mobileMenu" class="hidden flex-col mt-4 space-y-3 animate-slide-down">
            <a href="{{ route('about') }}" wire:navigate
                class="block hover:text-purple-200 transition-colors">Tentang</a>
        </div>
    </div>
</header>

<script>
    function toggleMobileMenu() {
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenu.classList.toggle('hidden');
    }
</script>

<style>
    /* Animasi custom */
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fade-in 0.8s ease-out;
    }

    @keyframes slide-down {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-slide-down {
        animation: slide-down 0.5s ease-out;
    }
</style>
