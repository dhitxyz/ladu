{{-- Navbar Sidebar Component --}}
<aside class="w-64 min-h-full flex flex-col">

    <nav class="flex-1 px-3 py-4 space-y-1 text-sm">

        {{-- Dashboard Link --}}
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 transition {{ request()->routeIs('admin.dashboard') ? 'bg-[#CA0B3E]/15 text-[#CA0B3E] font-semibold' : '' }}">
            <i class="fa fa-house"></i>
            <span>Dashboard</span>
        </a>

        {{-- Laporan Menu (Collapsible) --}}
        <div x-data="{ open: {{ request()->routeIs('admin.laporan*') ? 'true' : 'false' }} }" class="space-y-1">
            <button @click="open = !open"
                    class="w-full flex items-center justify-between px-3 py-2 rounded-lg hover:bg-gray-100 transition {{ request()->routeIs('admin.laporan*') ? 'bg-[#CA0B3E]/15 text-[#CA0B3E] font-semibold' : '' }}">
                <div class="flex items-center gap-3">
                    <i class="fa fa-file"></i>
                    <span>Laporan</span>
                </div>
                <i class="fa fa-chevron-down text-xs {{ request()->routeIs('admin.laporan*') ? 'text-[#CA0B3E]' : 'text-gray-400' }}" x-show="open"></i>
                <i class="fa fa-chevron-right text-xs {{ request()->routeIs('admin.laporan*') ? 'text-[#CA0B3E]' : 'text-gray-400' }}" x-show="!open"></i>
            </button>

            <div x-show="open" x-transition class="ml-7 space-y-1">
                <a href="{{ route('admin.laporan.index') }}"
                   class="flex items-center justify-between px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100 transition {{ !request('status') && request()->routeIs('admin.laporan.index') ? 'bg-gray-100 font-semibold text-gray-900' : '' }}">
                    <div class="flex items-center gap-2">
                        <i class="fa fa-list mr-2"></i>Semua Laporan
                    </div>
                    <span class="px-2 py-0.5 text-xs bg-gray-200 text-gray-700 rounded-full font-medium">{{ \App\Models\Laporan::count() }}</span>
                </a>

                <a href="{{ route('admin.laporan.index', ['status' => 'pending']) }}"
                   class="flex items-center justify-between px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100 transition {{ request('status') === 'pending' ? 'bg-gray-100 font-semibold text-gray-900' : '' }}">
                    <div class="flex items-center gap-2">
                        <i class="fa fa-hourglass-half mr-2"></i>Pending
                    </div>
                    <span class="px-2 py-0.5 text-xs bg-yellow-200 text-yellow-700 rounded-full font-medium">{{ \App\Models\Laporan::where('status', 'pending')->count() }}</span>
                </a>

                <a href="{{ route('admin.laporan.index', ['status' => 'diproses']) }}"
                   class="flex items-center justify-between px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100 transition {{ request('status') === 'diproses' ? 'bg-gray-100 font-semibold text-gray-900' : '' }}">
                    <div class="flex items-center gap-2">
                        <i class="fa fa-cog mr-2"></i>Diproses
                    </div>
                    <span class="px-2 py-0.5 text-xs bg-blue-200 text-blue-700 rounded-full font-medium">{{ \App\Models\Laporan::where('status', 'diproses')->count() }}</span>
                </a>

                <a href="{{ route('admin.laporan.index', ['status' => 'selesai']) }}"
                   class="flex items-center justify-between px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100 transition {{ request('status') === 'selesai' ? 'bg-gray-100 font-semibold text-gray-900' : '' }}">
                    <div class="flex items-center gap-2">
                        <i class="fa fa-check mr-2"></i>Selesai
                    </div>
                    <span class="px-2 py-0.5 text-xs bg-green-200 text-green-700 rounded-full font-medium">{{ \App\Models\Laporan::where('status', 'selesai')->count() }}</span>
                </a>
            </div>
        </div>

        {{-- Users Link --}}
        <a href="{{ route('admin.users') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 transition {{ request()->routeIs('admin.users*') ? 'bg-[#CA0B3E]/15 text-[#CA0B3E] font-semibold' : '' }}">
            <i class="fa fa-user"></i>
            <span>Users</span>
        </a>

    </nav>

</aside>
