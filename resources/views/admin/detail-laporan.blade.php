@extends('layouts.admin')

@section('content')

<div class="min-h-screen bg-[#fafafa] flex flex-col">
    <x-admin.topbar :title="'Detail Laporan'" />

    <div class="flex flex-1">
        <x-admin.navbar />

        <main class="flex-1 p-6 space-y-6">
            <div class="mb-4">
                <nav class="text-sm text-gray-500 flex items-center gap-2">
                    <a href="{{ route('admin.laporan.index') }}" class="hover:text-gray-700 text-[#CA0B3E]">
                        Laporan
                    </a>
                    <span>></span>
                    <span class="text-gray-900 font-medium">Detail Laporan</span>
                </nav>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-xl p-6 border border-gray-300/50">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900">{{ $laporan->judul }}</h1>
                                <p class="text-gray-500 mt-1">Dilaporkan oleh: <span class="font-medium">{{ $laporan->displayName }}</span></p>
                            </div>
                            <div>
                                @if($laporan->status === 'pending')
                                    <span class="px-4 py-2 text-sm rounded-full bg-yellow-100 text-yellow-700 font-semibold">Pending</span>
                                @elseif($laporan->status === 'diproses')
                                    <span class="px-4 py-2 text-sm rounded-full bg-blue-100 text-blue-700 font-semibold">Diproses</span>
                                @else
                                    <span class="px-4 py-2 text-sm rounded-full bg-green-100 text-green-700 font-semibold">Selesai</span>
                                @endif
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 pt-4 border-t border-gray-300/50">
                            <div>
                                <p class="text-sm text-gray-500">Jenis Laporan</p>
                                <p class="font-medium text-gray-900 mt-1">{{ ucfirst($laporan->classification) }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Kategori</p>
                                <p class="font-medium text-gray-900 mt-1">{{ $laporan->kategori }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Tanggal Laporan</p>
                                <p class="font-medium text-gray-900 mt-1">{{ $laporan->tanggal }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Lokasi</p>
                                <p class="font-medium text-gray-900 mt-1">{{ $laporan->lokasi }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-6 border border-gray-300/50">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Isi Laporan</h2>
                        <p class="text-gray-700 whitespace-pre-wrap leading-relaxed">{{ $laporan->isi }}</p>
                    </div>

                    @if($laporan->lampiran && count($laporan->lampiran) > 0)
                        <div class="bg-white rounded-xl p-6 border border-gray-300/50">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Lampiran</h2>
                            <div class="space-y-2">
                                @foreach($laporan->lampiran as $file)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center gap-3">
                                            <i class="fa fa-file text-gray-400"></i>
                                            <span class="text-gray-700">{{ basename($file) }}</span>
                                        </div>
                                        <a href="{{ asset('storage/' . $file) }}" target="_blank" class="text-[#CA0B3E] hover:text-[#CA0B3E]/80 font-medium">
                                            Download
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- INFO LAPORAN --}}
                    <div class="bg-white rounded-xl p-6 border border-gray-300/50">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Laporan</h2>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Bersifat Anonim:</span>
                                <span class="font-medium">{!! $laporan->anonim ? '<i class="fa fa-check text-green-600"></i> Ya' : '<i class="fa fa-times text-red-600"></i> Tidak' !!}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Bersifat Rahasia:</span>
                                <span class="font-medium">{!! $laporan->rahasia ? '<i class="fa fa-check text-green-600"></i> Ya' : '<i class="fa fa-times text-red-600"></i> Tidak' !!}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Instansi Terkait:</span>
                                <span class="font-medium">{{ $laporan->instansi ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between pt-3 border-t border-gray-300/50">
                                <span class="text-gray-600">Dibuat pada:</span>
                                <span class="font-medium">{{ $laporan->created_at->format('d M Y H:i') }}</span>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- RIGHT SIDE - STATUS & ACTION --}}
                <div class="space-y-6">

                    {{-- UBAH STATUS --}}
                    <div class="bg-white rounded-xl p-6 border border-gray-300/50 top-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Ubah Status</h3>

                        <form action="{{ route('admin.laporan.updateStatus', $laporan->id) }}" method="POST" class="space-y-4">
                            @csrf

                            <div class="space-y-3">
                                <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition" :class="{ 'border-yellow-500 bg-yellow-50': '{{ $laporan->status }}' === 'pending' }">
                                    <input type="radio" name="status" value="pending" {{ $laporan->status === 'pending' ? 'checked' : '' }} class="mr-3">
                                    <div>
                                        <p class="font-medium text-gray-900">Pending</p>
                                        <p class="text-xs text-gray-500">Belum diproses</p>
                                    </div>
                                </label>

                                <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition" :class="{ 'border-blue-500 bg-blue-50': '{{ $laporan->status }}' === 'diproses' }">
                                    <input type="radio" name="status" value="diproses" {{ $laporan->status === 'diproses' ? 'checked' : '' }} class="mr-3">
                                    <div>
                                        <p class="font-medium text-gray-900">Diproses</p>
                                        <p class="text-xs text-gray-500">Sedang ditangani</p>
                                    </div>
                                </label>

                                <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition" :class="{ 'border-green-500 bg-green-50': '{{ $laporan->status }}' === 'selesai' }">
                                    <input type="radio" name="status" value="selesai" {{ $laporan->status === 'selesai' ? 'checked' : '' }} class="mr-3">
                                    <div>
                                        <p class="font-medium text-gray-900">Selesai</p>
                                        <p class="text-xs text-gray-500">Laporan telah ditangani</p>
                                    </div>
                                </label>
                            </div>

                            <button type="submit" class="w-full bg-[#CA0B3E] text-white py-2 rounded-lg font-medium hover:bg-[#CA0B3E]/80 transition">
                                <i class="fa fa-save mr-2"></i>Simpan Perubahan
                            </button>
                        </form>
                    </div>

                    {{-- INFO USER --}}
                    <div class="bg-white rounded-xl p-6 border border-gray-300/50">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pelapor</h3>

                        <div class="space-y-3">
                            @if(!$laporan->anonim)
                                <div>
                                    <p class="text-sm text-gray-500">Nama</p>
                                    <p class="font-medium text-gray-900">{{ $laporan->user->nama_lengkap }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Email</p>
                                    <p class="font-medium text-gray-900">{{ $laporan->user->email }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">No. Telepon</p>
                                    <p class="font-medium text-gray-900">{{ $laporan->user->no_telepon ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Alamat</p>
                                    <p class="font-medium text-gray-900">{{ $laporan->user->alamat ?? '-' }}</p>
                                </div>
                                <a href="{{ route('admin.users.show', $laporan->user->id) }}" class="inline-block mt-4 text-[#CA0B3E] hover:text-[#CA0B3E]/80 font-medium">
                                    Lihat Profile User →
                                </a>
                            @else
                                <p class="text-gray-500 text-sm">Laporan ini bersifat anonim</p>
                            @endif
                        </div>
                    </div>

                </div>

            </div>

        </main>

    </div>
</div>

@endsection
