{{-- Topbar Header Component --}}
<header class="w-full bg-white px-6 py-3 flex items-center justify-between" style="box-shadow: 0 0 0 calc(1px + 0px) color-mix(in oklab, oklch(0.141 0.005 285.823) 5%, transparent);">
    <div>
        <h1 class="text-2xl font-semibold text-[#CA0B3E]">LADU (Layanan Aduan)</h1>
    </div>

    <div class="flex items-center gap-3">
        <button class="relative p-2 rounded-lg hover:bg-gray-100 transition text-lg text-gray-700">
            <i class="fa fa-bell"></i>
            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] px-1.5 rounded-full">
                {{ \App\Models\Laporan::where('status', 'pending')->count() }}
            </span>
        </button>

        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100 transition">
                <img src="{{ auth()->user()->jenis_kelamin === 'perempuan' ? 'https://www.lapor.go.id/../themes/lapor/assets/images/user-placeholder-f.png' : 'https://www.lapor.go.id/../themes/lapor/assets/images/user-placeholder-m.png' }}" alt="{{ auth()->user()->nama_lengkap }}" class="w-10 h-10 rounded-full object-cover">
            </button>

            <div x-show="open" @click.away="open = false" x-transition
                 class="absolute right-0 mt-2 w-44 bg-white border border-gray-300/50 rounded-lg shadow-lg overflow-hidden z-50">
                <div class="px-4 py-3 border-b border-gray-300/50">
                    <p class="text-sm font-medium text-gray-900">{{ auth()->user()->nama_lengkap }}</p>
                    <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                </div>

                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                    <i class="fa fa-user mr-2"></i>Profile
                </a>

                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                    <i class="fa fa-cog mr-2"></i>Settings
                </a>

                <form method="POST" action="/logout" class="border-t border-gray-300/50">
                    @csrf
                    <button class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-50 transition">
                        <i class="fa fa-sign-out mr-2"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
