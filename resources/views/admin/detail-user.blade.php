@extends('layouts.admin')

@section('content')

<div class="min-h-screen bg-[#fafafa] flex flex-col">
    <x-admin.topbar :title="'Detail User'" />

    <div class="flex flex-1">
        <x-admin.navbar />

        <main class="flex-1 p-6 space-y-6">
            <div class="mb-4">
                <nav class="text-sm text-gray-500 flex items-center gap-2">
                    <a href="{{ route('admin.users') }}" class="hover:text-gray-700 text-[#a51a39]">
                        Users
                    </a>
                    <span>></span>
                    <span class="text-gray-900 font-medium">Detail User</span>
                </nav>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-xl p-6 border border-gray-300/50">
                        <div class="flex items-start justify-between mb-6 pb-6 border-b border-gray-300/50">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900">{{ $user->nama_lengkap }}</h1>
                                <span class="inline-block mt-3 px-3 py-1 text-sm rounded-full font-medium {{ $user->role === 'admin' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>
                            <img src="{{ $user->jenis_kelamin === 'perempuan' ? asset('images/user-placeholder-f.png') : asset('images/user-placeholder-m.png') }}" alt="{{ $user->nama_lengkap }}" class="w-16 h-16 rounded-full object-cover border-2 border-gray-200">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Email</p>
                                <p class="font-medium text-gray-900 mt-1">{{ $user->email }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Username</p>
                                <p class="font-medium text-gray-900 mt-1">{{ $user->username }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">No. Telepon</p>
                                <p class="font-medium text-gray-900 mt-1">{{ $user->no_telepon ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">No. KTP</p>
                                <p class="font-medium text-gray-900 mt-1">{{ $user->nik ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Tanggal Lahir</p>
                                <p class="font-medium text-gray-900 mt-1">{{ $user->tanggal_lahir ? $user->tanggal_lahir : '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Jenis Kelamin</p>
                                <p class="font-medium text-gray-900 mt-1">{{ $user->jenis_kelamin ? ucfirst($user->jenis_kelamin) : '-' }}</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-sm text-gray-500">Alamat</p>
                                <p class="font-medium text-gray-900 mt-1">{{ $user->alamat ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="mt-6 pt-6 border-t border-gray-300/50 text-sm text-gray-500">
                            <p>User dibuat pada: <span class="font-medium">{{ $user->created_at->format('d M Y H:i') }}</span></p>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div class="bg-white rounded-xl p-4 border border-gray-300/50 text-center">
                            <p class="text-3xl font-bold text-gray-900">{{ $user->laporans()->count() }}</p>
                            <p class="text-sm text-gray-500 mt-1">Total Laporan</p>
                        </div>
                        <div class="bg-white rounded-xl p-4 border border-gray-300/50 text-center">
                            <p class="text-3xl font-bold text-yellow-600">{{ $user->laporans()->where('status', 'pending')->count() }}</p>
                            <p class="text-sm text-gray-500 mt-1">Pending</p>
                        </div>
                        <div class="bg-white rounded-xl p-4 border border-gray-300/50 text-center">
                            <p class="text-3xl font-bold text-green-600">{{ $user->laporans()->where('status', 'selesai')->count() }}</p>
                            <p class="text-sm text-gray-500 mt-1">Selesai</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl p-6 border border-gray-300/50">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Laporan Terbaru</h2>

                        @if($user->laporans()->count() > 0)
                            <div class="space-y-3">
                                @foreach($user->laporans()->latest()->take(5)->get() as $laporan)
                                    <a href="{{ route('admin.laporan.show', $laporan->id) }}" class="block p-4 border border-gray-300/50 rounded-lg hover:bg-gray-50 transition">
                                        <div class="flex items-start justify-between">
                                            <div>
                                                <p class="font-medium text-gray-900">{{ Str::limit($laporan->judul, 40) }}</p>
                                                <p class="text-xs text-gray-500 mt-1">{{ $laporan->created_at->format('d M Y') }}</p>
                                            </div>
                                            @if($laporan->status === 'pending')
                                                <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 font-medium whitespace-nowrap">Pending</span>
                                            @elseif($laporan->status === 'diproses')
                                                <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700 font-medium whitespace-nowrap">Diproses</span>
                                            @else
                                                <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium whitespace-nowrap">Selesai</span>
                                            @endif
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-4">User ini belum membuat laporan</p>
                        @endif
                    </div>

                </div>

                {{-- RIGHT SIDE - ACTIONS & INFO --}}
                <div class="lg:col-span-1 space-y-6">

                    {{-- ACTIONS CARD --}}
                    <div class="bg-white rounded-xl p-6 border border-gray-300/50">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi</h3>

                        <div class="space-y-3">
                            <button class="w-full px-4 py-2 rounded-lg border border-gray-300/50 text-gray-700 hover:bg-gray-50 transition font-medium">
                                <i class="fa fa-edit mr-2"></i>Edit User
                            </button>
                            <button onclick="if(confirm('Yakin ingin menghapus user ini?')) { /* delete action */ }" class="w-full px-4 py-2 rounded-lg border border-red-300/50 text-red-600 hover:bg-red-50 transition font-medium">
                                <i class="fa fa-trash mr-2"></i>Hapus User
                            </button>
                            <a href="{{ route('admin.laporan.index') }}?user={{ $user->id }}" class="block text-center px-4 py-2 rounded-lg bg-[#a51a39] text-white hover:bg-[#a51a39]/80 transition font-medium">
                                <i class="fa fa-file mr-2"></i>Lihat Laporan
                            </a>
                        </div>
                    </div>

                    {{-- INFO CARD --}}
                    <div class="bg-white rounded-xl p-6 border border-gray-300/50">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Tambahan</h3>

                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-500">Status Akun</p>
                                <p class="font-medium text-gray-900 mt-1">
                                    @if($user->email_verified_at)
                                        <span class="text-green-600"><i class="fa fa-check"></i> Terverifikasi</span>
                                    @else
                                        <span class="text-yellow-600"><i class="fa fa-hourglass-half"></i> Belum Terverifikasi</span>
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Penyandang Disabilitas</p>
                                <p class="font-medium text-gray-900 mt-1">{!! $user->penyandang_disabilitas ? '<i class="fa fa-check text-green-600"></i> Ya' : '<i class="fa fa-times text-red-600"></i> Tidak' !!}</p>
                            </div>
                            <div class="pt-3 border-t border-gray-300/50">
                                <p class="text-sm text-gray-500">Terakhir Login</p>
                                <p class="font-medium text-gray-900 mt-1">-</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </main>

    </div>
</div>

@endsection
