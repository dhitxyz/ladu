@extends('layouts.admin')

@section('content')

<div class="min-h-screen bg-[#fafafa] flex flex-col">

    {{-- TOPBAR COMPONENT --}}
    <x-admin.topbar :title="'Users'" />

    {{-- BODY --}}
    <div class="flex flex-1">

        {{-- NAVBAR COMPONENT --}}
        <x-admin.navbar />

        {{-- MAIN CONTENT --}}
        <main class="flex-1 p-6 space-y-6">

            {{-- HEADER --}}
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Manajemen Users</h1>
                </div>
            </div>

            {{-- SEARCH & FILTER --}}
            <div class="bg-white rounded-xl p-4 border border-gray-300/50 flex gap-4">
                <form method="GET" action="{{ route('admin.users') }}" class="flex gap-4 flex-1">
                    <input type="text" name="search" placeholder="Cari nama, email, atau username..."
                           value="{{ request('search') }}"
                           class="flex-1 px-4 py-2 rounded-lg border border-gray-300/50 focus:outline-none focus:ring focus:ring-[#CA0B3E]/50">
                    <button type="submit" class="px-6 py-2 bg-[#CA0B3E] text-white rounded-lg hover:bg-[#CA0B3E]/80 transition font-medium">
                        <i class="fa fa-search mr-2"></i>Cari
                    </button>
                </form>
            </div>

            {{-- TABLE --}}
            <div class="bg-white rounded-xl overflow-hidden border border-gray-300/50">

                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead class="bg-gray-50 text-left text-gray-500">
                            <tr>
                                <th class="p-4">No</th>
                                <th class="p-4">Nama Lengkap</th>
                                <th class="p-4">Username</th>
                                <th class="p-4">Email</th>
                                <th class="p-4">Role</th>
                                <th class="p-4">No. Telepon</th>
                                <th class="p-4">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">
                            @forelse($users as $index => $user)
                                <tr class="hover:bg-gray-50 border-t border-gray-300/50">
                                    <td class="p-4">{{ $users->firstItem() + $index }}</td>
                                    <td class="p-4 font-medium">{{ $user->nama_lengkap }}</td>
                                    <td class="p-4 text-gray-600">{{ $user->username }}</td>
                                    <td class="p-4 text-gray-600">{{ $user->email }}</td>
                                    <td class="p-4">
                                        <span class="px-3 py-1 text-xs rounded-full font-medium {{ $user->role === 'admin' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-gray-600">{{ $user->no_telepon ?? '-' }}</td>
                                    <td class="p-4">
                                        <a href="{{ route('admin.users.show', $user->id) }}" class="text-[#CA0B3E] font-medium hover:underline">
                                            Lihat Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-4 text-center text-gray-500">Tidak ada user</td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>

                </div>

            </div>

            {{-- PAGINATION --}}
            <div class="mt-6">
                {{ $users->links() }}
            </div>

        </main>

    </div>
</div>

@endsection
