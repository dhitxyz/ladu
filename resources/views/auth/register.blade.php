@extends('layouts.auth')

@section('content')

<div class="py-18 bg-cover relative" style="background-image: url('{{ asset('images/bg.jpg') }}')">

    <div class="flex justify-center mb-18">
        <a href="/">
            <img src="{{ asset('images/logo-white.png') }}" alt="Logo" class="h-12 object-contain">
        </a>
    </div>

    <div class="max-w-175 bg-white rounded-lg shadow p-8 mx-auto">

        <h1 class="text-[44px] text-[#333333] font-bold text-center mb-5">Daftar</h1>

        <div class="bg-[#165eb3] text-white text-[12px] p-7.5 rounded mb-6 shadow">
            <b>
                <i class="fa-solid fa-circle-info"></i>
                Mengapa kami meminta data ini?
            </b>
            <br>
            Layanan SP4N-LAPOR! mengumpulkan data pribadi pengguna sebagai jaminan keabsahan dari aduan atau aspirasi yang disampaikan, pengenal identitas, memverifikasi akun dan mengirim notifikasi laporan, menilai tingkat partisipasi publik, pengolahan dan analisis data, penyusunan perencanaan dan pengambilan kebijakan, monitoring dan evaluasi, dan mendorong terciptanya kebijakan yang inklusif.
        </div>

        <form method="POST" action="{{ route('register') }}" autocomplete="off">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block text-xs text-gray-600 mb-1 font-semibold">NIK</label>
                    <input type="text" name="nik" value="{{ old('nik') }}"
                        placeholder="Nomor Induk Kependudukan (KTP)"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-[#C70D3C] focus:ring-2 focus:ring-red-100 outline-none transition">
                </div>

                <div>
                    <label class="block text-xs text-gray-600 mb-1 font-semibold">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                        placeholder="Nama Lengkap"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-[#C70D3C] focus:ring-2 focus:ring-red-100 outline-none transition">
                </div>

                <div>
                    <label class="block text-xs text-gray-600 mb-1 font-semibold">Tempat Tinggal Saat Ini <span class="text-red-500">*</span></label>
                    <input type="text" name="alamat" value="{{ old('alamat') }}"
                        placeholder="Ketik Tempat Tinggal Saat Ini"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-[#C70D3C] focus:ring-2 focus:ring-red-100 outline-none transition">
                </div>

                <div>
                    <label class="block text-xs text-gray-600 mb-1 font-semibold">Tanggal Lahir <span class="text-red-500">*</span></label>

                    <div class="relative">
                        <input type="text" id="tanggal" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                            placeholder="Pilih Tanggal Lahir" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-[#C70D3C] focus:ring-2 focus:ring-red-100 outline-none transition">

                        <div class="absolute top-0 right-0 h-full flex items-center px-3 bg-gray-100 border border-gray-300 rounded-r-lg">
                            <i class="fa-solid fa-calendar text-gray-600"></i>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs text-gray-600 mb-1 font-semibold">Jenis Kelamin <span class="text-red-500">*</span></label>

                    <div class="relative w-full">
                        <select name="jenis_kelamin" required
                            class="appearance-none w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-[#C70D3C] focus:ring-2 focus:ring-red-100 outline-none transition">
                            <option value="" disabled selected hidden>Pilih Jenis Kelamin</option>
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>

                        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-chevron-down text-gray-500 text-sm"></i>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs text-gray-600 mb-1 font-semibold">No. Telp Aktif <span class="text-red-500">*</span></label>
                    <input type="text" name="no_telepon" value="{{ old('no_telepon') }}" required
                        placeholder="Minimal 8-14 Angka"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-[#C70D3C] focus:ring-2 focus:ring-red-100 outline-none transition">
                </div>

                <div>
                    <label class="block text-xs text-gray-600 mb-1 font-semibold">Pekerjaan</label>

                    <div class="relative w-full">
                        <select name="pekerjaan"
                            class="appearance-none w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-[#C70D3C] focus:ring-2 focus:ring-red-100 outline-none transition">

                            <option disabled selected hidden>Pilih Pekerjaan</option>

                            @foreach ($pekerjaans as $key => $value)
                                <option value="{{ $key }}" {{ old('pekerjaan') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach

                        </select>

                        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-chevron-down text-gray-500 text-sm"></i>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs text-gray-600 mb-1 font-semibold">Penyandang Disabilitas?</label>

                    <div class="relative w-full">
                        <select name="penyandang_disabilitas"
                            class="appearance-none w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-[#C70D3C] focus:ring-2 focus:ring-red-100 outline-none transition">

                            <option disabled selected hidden>Pilih Status</option>
                            <option value="tidak" {{ old('penyandang_disabilitas') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                            <option value="ya" {{ old('penyandang_disabilitas') == 'ya' ? 'selected' : '' }}>Ya</option>

                        </select>

                        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-chevron-down text-gray-500 text-sm"></i>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs text-gray-600 mb-1 font-semibold">Username <span class="text-red-500">*</span></label>
                    <input type="text" name="username" value="{{ old('username') }}" required
                        placeholder="Username"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-[#C70D3C] focus:ring-2 focus:ring-red-100 outline-none transition">
                </div>

                <div>
                    <label class="block text-xs text-gray-600 mb-1 font-semibold">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        placeholder="ladu@contoh.com"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-[#C70D3C] focus:ring-2 focus:ring-red-100 outline-none transition">
                </div>

                <div>
                    <label class="block text-xs text-gray-600 mb-1 font-semibold">Password <span class="text-red-500">*</span></label>
                    <input type="password" name="password" required
                        placeholder="********"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-[#C70D3C] focus:ring-2 focus:ring-red-100 outline-none transition">

                    <p class="text-[13px] text-gray-500 mt-1">
                        Minimal 8 karakter dan harus berisi kombinasi huruf kapital, huruf kecil, angka dan karakter khusus (@$!%*#?&).
                    </p>
                </div>

                <div>
                    <label class="block text-xs text-gray-600 mb-1 font-semibold">Password Confirmation <span class="text-red-500">*</span></label>
                    <input type="password" name="password_confirmation" required
                        placeholder="********"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-[#C70D3C] focus:ring-2 focus:ring-red-100 outline-none transition">
                </div>

            </div>

            <button class="cursor-pointer w-full font-medium mt-6 bg-[#CA0B3E] text-white py-3 rounded-md shadow hover:bg-[#aa0b33] transition">
                DAFTAR
            </button>

        </form>

    </div>
</div>

@endsection
