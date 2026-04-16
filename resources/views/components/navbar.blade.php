<nav
    x-data="navbarScroll()"
    x-init="init()"
    :class="scrolled ? 'bg-white text-[#CA0B3E] shadow-md' : 'bg-transparent text-white'"
    class="fixed top-0 left-0 w-full z-50"
>
    <div class="max-w-6xl mx-auto flex items-center justify-between px-4 py-6 font-medium">

        <div class="flex items-center gap-8">
            <a href="/">
                <img
                    :src="scrolled
                        ? '{{ asset('images/logo-red.png') }}'
                        : '{{ asset('images/logo-white.png') }}'"
                    alt="Logo"
                    class="h-10"
                />
            </a>

            <a href="#">Tentang LADU!</a>
            <a href="#">Statistik</a>

            @auth
                <a href="#">Laporan</a>
            @endauth
        </div>

        <div class="flex items-center gap-8">
            @guest
                <button command="show-modal" commandfor="dialog" class="cursor-pointer">
                    Masuk
                </button>

                <a href="{{ route('register') }}"
                    :class="scrolled
                        ? 'border border-[#CA0B3E] px-6 py-2 rounded hover:bg-[#CA0B3E] hover:text-white transition'
                        : 'border border-white px-6 py-2 rounded hover:bg-white hover:text-[#CA0B3E] transition'">
                    Daftar
                </a>
            @endguest

@auth
<div class="flex items-center gap-6">

    <!-- Notifikasi -->
    <button class="relative">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 17h5l-1.405-1.405C18.79 14.79 18 13.418 18 12V9a6 6 0 10-12 0v3c0 1.418-.79 2.79-1.595 3.595L3 17h5m7 0a3 3 0 11-6 0" />
        </svg>

    </button>

    <!-- Profile Dropdown -->
    <div x-data="{ open: false }" class="relative">

        <button @click="open = !open" class="flex items-center gap-2">

            <!-- Avatar huruf -->
            <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold">
                <img src="{{ auth()->user()->jenis_kelamin === 'perempuan' ? 'https://www.lapor.go.id/../themes/lapor/assets/images/user-placeholder-f.png' : 'https://www.lapor.go.id/../themes/lapor/assets/images/user-placeholder-m.png' }}" alt="">
            </div>

            <!-- Nama -->
            <span>{{ auth()->user()->username }}</span>


                <i class="fa-solid fa-caret-down fa-xs transition-transform"
   :class="open ? 'rotate-180' : ''"></i>

        </button>

        <!-- Dropdown -->
        <div x-show="open" @click.away="open = false"
            class="absolute right-0 py-3 w-40 bg-white text-sm text-black font-normal shadow-md rounded">

            <a href="{{ route('laporan.store') }}" class="block px-4 py-2 hover:bg-gray-100">Laporan Saya</a>
                    <div class="w-full flex items-center my-2">
          <hr class="grow border-gray-300">
        </div>

        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Ubah Profile</a>
        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Notifikasi</a>
        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Ubah Password</a>
                            <div class="w-full flex items-center my-2">
          <hr class="grow border-gray-300">
        </div>
            <form method="POST" action="{{ route('logout') }}"  onsubmit="return confirm('okegas')">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">
                    Logout
                </button>
            </form>

        </div>
    </div>

</div>
@endauth
        </div>

    </div>
</nav>

<script>
const isDetail = {{ Request::is('laporan/*') ? 'true' : 'false' }};

function navbarScroll() {
    return {
        scrolled: isDetail,

        init() {
            if (isDetail) return;

            this.handleScroll();
            window.addEventListener('scroll', () => this.handleScroll());
        },

        handleScroll() {
            this.scrolled = window.scrollY > 50;
        }
    }
}
</script>

@include('auth.login')
