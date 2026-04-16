@extends('layouts.admin')

@section('content')

<div class="min-h-screen bg-[#fafafa] flex flex-col">
    <x-admin.topbar />

    <div class="flex flex-1">
        <x-admin.navbar />

        <main class="flex-1 p-6 space-y-6">
            <div class="mb-4">
                <nav class="text-sm text-gray-500 flex items-center gap-2">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-700 text-[#a51a39]">
                        Dashboard
                    </a>
                    <span>></span>
                    <span class="text-gray-900 font-medium">
                        @if(!$status)
                            Semua Laporan
                        @elseif($status === 'pending')
                            Laporan Pending
                        @elseif($status === 'diproses')
                            Laporan Diproses
                        @else
                            Laporan Selesai
                        @endif
                    </span>
                </nav>
            </div>

            <h1 class="text-2xl font-bold text-gray-900">
                @if(!$status)
                    Daftar Semua Laporan
                @elseif($status === 'pending')
                    Laporan Pending
                @elseif($status === 'diproses')
                    Laporan Diproses
                @else
                    Laporan Selesai
                @endif
            </h1>

            <div class="bg-white rounded-xl p-4 border border-gray-300/50 flex gap-4">
                <form method="GET" action="{{ route('admin.laporan.index') }}" class="flex gap-4 flex-1">
                    @if(request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}">
                    @endif
                    <input type="text" name="search" placeholder="Cari judul laporan atau nama user..."
                           value="{{ request('search') }}"
                           class="flex-1 px-4 py-2 rounded-lg border border-gray-300/50 focus:outline-none focus:ring focus:ring-[#a51a39]/50">
                    <button type="submit" class="px-6 py-2 bg-[#a51a39] text-white rounded-lg hover:bg-[#a51a39]/80 transition font-medium">
                        <i class="fa fa-search mr-2"></i>Cari
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-xl overflow-hidden border border-gray-300/50">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-left text-gray-500">
                            <tr>
                                <th class="p-4">No</th>
                                <th class="p-4">User</th>
                                <th class="p-4">Judul Laporan</th>
                                <th class="p-4">Kategori</th>
                                <th class="p-4">Tanggal</th>
                                <th class="p-4">Status</th>
                                <th class="p-4">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">
                            @forelse($laporans as $index => $laporan)
                                <tr class="hover:bg-gray-50 border-t border-gray-300/50">
                                    <td class="p-4">{{ $laporans->firstItem() + $index }}</td>
                                    <td class="p-4 font-medium">{{ $laporan->displayName }}</td>
                                    <td class="p-4 text-gray-600">{{ Str::limit($laporan->judul, 25) }}</td>
                                    <td class="p-4 text-gray-600">{{ $laporan->kategori }}</td>
                                    <td class="p-4 text-gray-600">{{ $laporan->created_at->format('d M Y') }}</td>
                                    <td class="p-4">
                                        @if($laporan->status === 'pending')
                                            <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 font-medium">Pending</span>
                                        @elseif($laporan->status === 'diproses')
                                            <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700 font-medium">Diproses</span>
                                        @else
                                            <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">Selesai</span>
                                        @endif
                                    </td>
                                    <td class="p-4">
                                        <a href="{{ route('admin.laporan.show', $laporan->id) }}" class="text-[#a51a39] font-medium hover:underline">
                                            Lihat Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-4 text-center text-gray-500">Tidak ada laporan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6">
                {{ $laporans->links() }}
            </div>
        </main>
    </div>
</div>

@endsection
