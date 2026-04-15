@extends('layouts.app')

@section('content')

<section>
    <div class="w-full mx-auto">

        <div class="bg-white shadow overflow-hidden">

            <div class="relative h-96 bg-gray-300">
                <img src="images/bg.jpg" class="w-full h-full object-cover">

                <div class="absolute bottom-0 left-0 w-full px-52 pb-6 flex justify-between items-end">

                    <div class="flex items-center gap-4">
                        <img src="https://www.lapor.go.id/themes/lapor/assets/images/user-placeholder-f.png"
                             class="w-32 h-32 rounded-full border-4 border-white object-cover">

                        <h1 class="text-2xl font-bold text-white drop-shadow">
                            {{ auth()->user()->username }}
                        </h1>
                    </div>

                    <div class="flex items-center gap-10 text-white">

                        <div class="text-center">
                            <span class="text-lg font-bold">{{ $laporans->count() }}</span><br>
                            <span class="text-sm">laporan</span>
                        </div>

                        <div class="text-center">
                            <span class="text-lg font-bold">0</span><br>
                            <span class="text-sm">mengikuti</span>
                        </div>

                        <div class="text-center">
                            <span class="text-lg font-bold">0</span><br>
                            <span class="text-sm">pengikut</span>
                        </div>

                        <a href="#"
                           class="ml-4 px-5 py-2 border border-white rounded-lg text-white hover:bg-white hover:text-black transition">
                            Ubah
                        </a>

                    </div>

                </div>
            </div>

            <div class="bg-white border-t border-gray-200">
                <div class="px-52 pt-6 flex gap-10 text-sm font-medium text-gray-600">

                    <button id="tab-semua"
                            onclick="setActiveTab(this); filterTab('semua')"
                            class="tab-btn relative pb-3 border-b-2 border-red-500 text-red-600">
                        Semua
                    </button>

                    <button onclick="setActiveTab(this); filterTab('belum_diproses')"
                            class="tab-btn relative pb-3 border-b-2 border-transparent">
                        Belum Diproses
                    </button>

                    <button onclick="setActiveTab(this); filterTab('proses')"
                            class="tab-btn relative pb-3 border-b-2 border-transparent">
                        Diproses
                    </button>

                    <button onclick="setActiveTab(this); filterTab('selesai')"
                            class="tab-btn relative pb-3 border-b-2 border-transparent">
                        Selesai
                    </button>

                </div>
            </div>

            <div class="bg-gray-50 py-10">
                <div class="px-52">

                    @if($laporans->count() > 0)

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

                            @foreach($laporans as $laporan)

                                <div class="relative bg-white rounded-lg shadow-sm border p-5 hover:shadow-md transition"
                                     data-status="{{ $laporan->status }}">

                                    @if($laporan->status === 'belum_diproses')
                                        <div class="absolute top-3 right-3 flex gap-3 text-xs">

                                            <a href="/laporan/{{ $laporan->id }}/edit"
                                               class="flex items-center gap-1 text-blue-500 hover:text-blue-700">
                                                <i class="fa fa-edit"></i>
                                                Edit
                                            </a>

                                            <form action="/laporan/{{ $laporan->id }}" method="POST"
                                                  onsubmit="return confirm('Hapus laporan ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="flex items-center gap-1 text-red-500 hover:text-red-700">
                                                    <i class="fa fa-trash"></i>
                                                    Hapus
                                                </button>
                                            </form>

                                        </div>
                                    @endif

                                    <h3 class="font-semibold text-gray-800">
                                        {{ $laporan->judul }}
                                    </h3>

                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ Str::limit($laporan->isi, 100) }}
                                    </p>

                                    <div class="flex justify-between items-center mt-4 text-xs text-gray-400">

                                        <span>
                                            @if($laporan->status === 'selesai')
                                                <span class="text-green-600 font-medium">Selesai</span>
                                            @elseif($laporan->status === 'proses')
                                                <span class="text-yellow-600 font-medium">Diproses</span>
                                            @else
                                                <span class="text-red-600 font-medium">Belum Diproses</span>
                                            @endif
                                        </span>

                                        <span>
                                            {{ $laporan->created_at->format('d M Y') }}
                                        </span>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @else

                        <div class="text-center text-gray-400 py-10">
                            Belum ada laporan
                        </div>

                    @endif

                </div>
            </div>

        </div>

    </div>
</section>

<script>
function filterTab(status) {
    const cards = document.querySelectorAll('[data-status]');

    cards.forEach(card => {
        if (status === 'semua') {
            card.style.display = 'block';
            return;
        }

        card.style.display =
            card.dataset.status === status ? 'block' : 'none';
    });
}
</script>

<script>
function setActiveTab(el) {
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('border-red-500', 'text-red-600');
        btn.classList.add('border-transparent', 'text-gray-600');
    });

    el.classList.add('border-red-500', 'text-red-600');
    el.classList.remove('border-transparent', 'text-gray-600');
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const defaultTab = document.getElementById('tab-semua');

    setActiveTab(defaultTab);
    filterTab('semua');
});
</script>

@endsection
