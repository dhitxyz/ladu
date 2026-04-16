@extends('layouts.admin')

@section('content')

<div class="min-h-screen bg-[#fafafa] flex flex-col">
    <x-admin.topbar :title="'Dashboard'" />

    <div class="flex flex-1">
        <x-admin.navbar />

        <main class="flex-1 p-6 space-y-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    Selamat Datang, {{ auth()->user()->nama_lengkap }}!
                </h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <div class="bg-white rounded-xl p-5 border border-gray-300/50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Total Laporan</p>
                            <h2 class="text-3xl font-bold text-gray-900 mt-2">{{ $totalLaporan }}</h2>
                        </div>
                        <div class="text-4xl text-gray-400"><i class="fa fa-clipboard"></i></div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-5 border border-gray-300/50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Pending</p>
                            <h2 class="text-3xl font-bold text-yellow-500 mt-2">{{ $pendingLaporan }}</h2>
                        </div>
                        <div class="text-4xl text-yellow-400"><i class="fa fa-hourglass"></i></div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-5 border border-gray-300/50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Diproses</p>
                            <h2 class="text-3xl font-bold text-blue-500 mt-2">{{ $diprosesDaporan }}</h2>
                        </div>
                        <div class="text-4xl text-blue-400"><i class="fa fa-cog"></i></div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-5 border border-gray-300/50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Selesai</p>
                            <h2 class="text-3xl font-bold text-green-500 mt-2">{{ $selesaiLaporan }}</h2>
                        </div>
                        <div class="text-4xl text-green-400"><i class="fa fa-check"></i></div>
                    </div>
                </div>

            </div>

            <div class="bg-white rounded-xl p-4 border border-gray-300/50 flex gap-4">
                <form method="GET" action="{{ route('admin.dashboard') }}" class="flex gap-4 flex-1">
                    <input type="text" name="search" placeholder="Cari judul laporan atau nama user..."
                           value="{{ request('search') }}"
                           class="flex-1 px-4 py-2 rounded-lg border border-gray-300/50 focus:outline-none focus:ring focus:ring-[#CA0B3E]/50">
                    <button type="submit" class="px-6 py-2 bg-[#CA0B3E] text-white rounded-lg hover:bg-[#CA0B3E]/80 transition font-medium">
                        <i class="fa fa-search mr-2"></i>Cari
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-xl overflow-hidden border border-gray-300/50">
                <div class="p-5 border-b border-gray-300/50">
                    <h2 class="font-semibold text-gray-900">Laporan Terbaru</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-left text-gray-500">
                            <tr>
                                <th class="p-4">User</th>
                                <th class="p-4">Judul Laporan</th>
                                <th class="p-4">Kategori</th>
                                <th class="p-4">Status</th>
                                <th class="p-4">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">
                            @forelse($laporanTerbaru as $laporan)
                                <tr class="hover:bg-gray-50 border-t border-gray-300/50">
                                    <td class="p-4 font-medium">{{ $laporan->displayName }}</td>
                                    <td class="p-4 text-gray-600">{{ Str::limit($laporan->judul, 30) }}</td>
                                    <td class="p-4 text-gray-600">{{ $laporan->kategori }}</td>
                                    <td class="p-4">
                                        @if($laporan->status === 'pending')
                                            <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700 font-medium">Pending</span>
                                        @elseif($laporan->status === 'diproses')
                                            <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-700 font-medium">Diproses</span>
                                        @else
                                            <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700 font-medium">Selesai</span>
                                        @endif
                                    </td>
                                    <td class="p-4">
                                        <a href="{{ route('admin.laporan.show', $laporan->id) }}" class="text-[#CA0B3E] font-medium hover:underline">
                                            Lihat Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-4 text-center text-gray-500">Tidak ada laporan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

@endsection
