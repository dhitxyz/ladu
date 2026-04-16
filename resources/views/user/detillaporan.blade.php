@extends('layouts.app')

@section('content')

<body style="background: #F7F8F9">
<div class="max-w-5xl mx-auto py-36">

    <div class="bg-white rounded-md shadow-xl px-14 py-8 space-y-4">

        <div class="flex items-start justify-between text-sm text-gray-500 flex-wrap gap-3">

            <div class="flex items-start gap-4 flex-1 min-w-0">

                <img src="{{ auth()->user()->jenis_kelamin === 'perempuan' ? asset('images/user-placeholder-f.png') : asset('images/user-placeholder-m.png') }}"
                     class="w-12 h-12 rounded-full shrink-0">

                <div class="flex flex-col gap-1 min-w-0 w-full">

                    <div class="flex items-center gap-3 flex-wrap">

                        <span class="text-base font-semibold text-gray-900 truncate">
                            {{ $laporan->display_name }}
                        </span>

                        <div class="flex items-center gap-3 text-xs text-gray-500 shrink-0">
                            <span class="flex items-center gap-1 whitespace-nowrap">
                                <i class="fa fa-calendar"></i>
                                {{ $laporan->created_at->format('d M Y, H:i') }}
                            </span>

                            <span class="flex items-center gap-1 whitespace-nowrap">
                                <i class="fa fa-globe"></i>
                                Web
                            </span>
                        </div>

                    </div>

                    <span class="text-xs text-gray-500 border rounded-md px-2 w-fit">
                        {{ $laporan->status === 'selesai'
                            ? 'Selesai ditangani'
                            : ($laporan->status === 'proses'
                                ? 'Sedang ditindaklanjuti'
                                : 'Menunggu respon instansi') }}
                    </span>

                </div>
            </div>

            <div class="shrink-0 text-xs">
                @php
                    $status = $laporan->status;
                @endphp

                <span class="px-3 py-1.5 rounded-full font-semibold
                    {{ $status === 'selesai'
                        ? 'bg-green-100 text-green-600'
                        : ($status === 'proses'
                            ? 'bg-yellow-100 text-yellow-600'
                            : 'bg-red-100 text-red-600') }}">

                    {{ $status === 'selesai'
                        ? 'Selesai'
                        : ($status === 'proses' ? 'Diproses' : 'Menunggu Diproses') }}
                </span>
            </div>

        </div>

        <div class="px-16">

            <div class="text-xs text-gray-600">
                Terdisposisi ke
                <span class="font-semibold text-gray-800">
                    {{ $laporan->instansi ?? '-' }}
                </span>
            </div>

            <div class="text-sm text-gray-600 pt-2">
                Tracking ID :
                <b>#{{ str_pad($laporan->id, 6, '0', STR_PAD_LEFT) }}</b>
            </div>

            <h1 class="text-[26px] font-bold text-[#0e3a6f] pt-4">
                {{ $laporan->judul }}
            </h1>

            <p class="text-[16px] text-gray-600 leading-relaxed pt-4">
                {{ $laporan->isi }}
            </p>

            <div class="flex flex-wrap gap-2 text-xs text-gray-500 pt-4">

                <span>
                    <i class="fa fa-calendar fa-fw"></i>
                    {{ $laporan->tanggal
                        ? strtoupper(
                            \Carbon\Carbon::parse($laporan->tanggal)
                                ->locale('id')
                                ->translatedFormat('l, Y/m/d')
                        )
                        : '-' }}
                </span>

                <span>|</span>

                <span>
                    <i class="fa fa-location-dot fa-fw"></i>
                    {{ $laporan->lokasi ? strtoupper($laporan->lokasi) : '-' }}
                </span>

                <span>|</span>

                <span>
                    <i class="fa fa-bookmark fa-fw"></i>
                    {{ $laporan->kategori
                        ? strtoupper(str_replace('_', ' ', $laporan->kategori))
                        : '-' }}
                </span>

            </div>

            @if($laporan->lampiran && count($laporan->lampiran))

                <div class="pt-4">
                    <div class="flex gap-4 flex-wrap">

                        @foreach($laporan->lampiran as $file)

                            @php
                                $url = asset('storage/' . $file);
                                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                            @endphp
                                <img src="{{ $url }}"
                                     class="w-20 h-20 rounded-md object-cover cursor-pointer hover:opacity-80 transition"
                                     onclick="openPreview('{{ $url }}')">

                        @endforeach

                    </div>
                </div>

            @endif

            <div class="pt-3 border-b py-2 flex flex-wrap gap-4 text-sm text-gray-600">

                <a href="#" class="hover:text-blue-600 flex items-center gap-1">
                    <i class="fa fa-exchange fa-fw"></i> Tindak Lanjut
                </a>

                <a href="#" class="hover:text-blue-600 flex items-center gap-1">
                    <i class="fa-regular fa-comment"></i> Respon Instansi
                </a>

                <a href="#" class="hover:text-blue-600 flex items-center gap-1">
                    <i class="fa fa-share"></i> Bagikan
                </a>

            </div>

        </div>
    </div>
</div>
</body>

@endsection

<div id="imageModal"
     class="fixed inset-0 bg-black/80 hidden items-center justify-center z-60">

    <span class="absolute top-5 right-5 text-white text-3xl cursor-pointer"
          onclick="closePreview()">
        &times;
    </span>

    <img id="previewImage"
         class="max-w-[80%] max-h-[80%] rounded-lg shadow-lg">
</div>

<script>
function openPreview(src) {
    const modal = document.getElementById('imageModal');
    const img = document.getElementById('previewImage');

    img.src = src;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closePreview() {
    const modal = document.getElementById('imageModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

document.getElementById('imageModal').addEventListener('click', function (e) {
    if (e.target === this) closePreview();
});
</script>
