@extends('layouts.app')

@section('content')

<body class="bg-[#F7F8F9]">

<section>
    <div class="w-full mx-auto">

        <div class="overflow-hidden">

            <div class="relative h-96">
                <img src="images/bg.jpg" class="w-full h-full object-cover">

                <div class="absolute bottom-0 left-0 w-full px-52 pb-6 flex justify-between items-end">

                    <div class="flex items-center gap-4">
                        <img src="{{ auth()->user()->jenis_kelamin === 'perempuan' ? 'https://www.lapor.go.id/../themes/lapor/assets/images/user-placeholder-f.png' : 'https://www.lapor.go.id/../themes/lapor/assets/images/user-placeholder-m.png' }}" alt="{{ auth()->user()->nama_lengkap }}" class="w-32 h-32 rounded-full border-4 border-white object-cover">

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

            <div class="border-t border-gray-200">
                <div class="px-52 pt-6 flex gap-10 text-sm font-medium text-gray-600">

                    @php
                        $tabs = [
                            'semua' => 'Semua',
                            'pending' => 'Belum Diproses',
                            'diproses' => 'Diproses',
                            'selesai' => 'Selesai',
                        ];
                    @endphp

                    @foreach ($tabs as $key => $label)
                        <button
                            id="{{ $key === 'semua' ? 'tab-semua' : '' }}"
                            onclick="setActiveTab(this); filterTab('{{ $key }}')"
                            class="tab-btn pb-3 border-b-2 {{ $key === 'semua'
                                ? 'border-red-500 text-red-600'
                                : 'border-transparent text-gray-600' }}"
                        >
                            {{ $label }}
                        </button>
                    @endforeach

                </div>
            </div>

            <div class="py-10">
                <div class="px-52">

                    @if($laporans->count())

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            @foreach($laporans as $laporan)

                                <a href="{{ url('/laporan/'.$laporan->id) }}"
                                   class="block"
                                   data-status="{{ $laporan->status }}">

                                    <div class="bg-white rounded-lg shadow-sm p-5 hover:shadow-md transition h-full flex flex-col justify-between">

                                        <div class="flex justify-between items-start gap-3">

                                            <h3 class="font-semibold text-gray-800 truncate">
                                                {{ $laporan->judul }}
                                            </h3>

                                            @php
                                                $status = $laporan->status;
                                            @endphp

                                            <span class="text-xs whitespace-nowrap pt-1.5 px-2 py-1 rounded-full font-semibold
                                                {{ $status === 'selesai'
                                                    ? 'bg-green-100 text-green-600'
                                                    : ($status === 'diproses'
                                                        ? 'bg-yellow-100 text-yellow-600'
                                                        : 'bg-red-100 text-red-600') }}">
                                                {{ $status === 'selesai'
                                                    ? 'Selesai'
                                                    : ($status === 'diproses'
                                                        ? 'Diproses'
                                                        : 'Belum Diproses') }}
                                            </span>

                                        </div>

                                        <p class="text-sm text-gray-500 mt-2">
                                            {{ Str::limit($laporan->isi, 100) }}
                                        </p>

                                        <div class="flex justify-between items-center mt-4 text-xs text-gray-400">
                                            <span>{{ $laporan->created_at->format('d M Y') }}</span>
                                        </div>

                                    </div>

                                </a>

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

</body>

<script>
function filterTab(status) {
    document.querySelectorAll('[data-status]').forEach(card => {
        card.style.display = (status === 'semua' || card.dataset.status === status)
            ? 'block'
            : 'none';
    });
}

function setActiveTab(el) {
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('border-red-500', 'text-red-600');
        btn.classList.add('border-transparent', 'text-gray-600');
    });

    el.classList.add('border-red-500', 'text-red-600');
    el.classList.remove('border-transparent', 'text-gray-600');
}

document.addEventListener('DOMContentLoaded', () => {
    const defaultTab = document.getElementById('tab-semua');
    if (defaultTab) {
        setActiveTab(defaultTab);
        filterTab('semua');
    }
});
</script>

@endsection
