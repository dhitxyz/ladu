<div class="relative z-40 max-w-2xl mx-auto -mt-40 px-8 py-6 bg-white rounded-lg shadow-lg">

    @if(session('success'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-transition
        class="bg-green-100 text-green-700 p-3 mb-4 rounded text-sm flex items-center justify-between"
    >
        <span>{{ session('success') }}</span>
        <button
            x-on:click="show = false"
            class="ml-3 cursor-pointer text-green-700 hover:text-green-900"
        >
            ✕
        </button>
    </div>
    @endif

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
        <ul class="text-sm">
            @foreach ($errors->all() as $error)
            <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="mb-6">
        <h1 class="text-xl font-medium text-white pl-3.5 py-2.5 mb-1 bg-[#a51a39]">
            Sampaikan laporan anda
        </h1>
    </div>

    <form id="formLaporan" action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf

        <div class="mb-5 px-3.5">
            <SectionLabel>Pilih Klasifikasi Laporan</SectionLabel>
            <div
                x-data="{ classification: '{{ old('classification') }}' }"
                class="flex mt-1.5 border border-[#C70D3C] rounded-lg overflow-hidden"
            >
                @foreach ($classifications as $value => $label)
                <label
                    class="flex-1 cursor-pointer text-center py-3 text-xs font-semibold transition-all {{ !$loop->last ? 'border-r border-[#a51a39]' : '' }}"
                    :class="classification === '{{ $value }}'
                        ? 'bg-[#a51a39] text-white'
                        : 'bg-transparent text-[#a51a39] hover:bg-red-50'"
                >
                    <input
                        type="radio"
                        name="classification"
                        value="{{ $value }}"
                        x-model="classification"
                        class="hidden"
                        required
                    >
                    <span class="flex items-center justify-center gap-2">
                        <template x-if="classification === '{{ $value }}'">
                            <i class="fa-solid fa-check"></i>
                        </template>
                        <template x-if="classification !== '{{ $value }}'">
                            <span class="w-4 h-4 border border-[#a51a39] rounded-full"></span>
                        </template>
                        {{ strtoupper($label) }}
                    </span>
                </label>
                @endforeach
            </div>

            <p class="text-xs text-center mt-4 text-gray-500 flex items-center justify-center gap-2">
                Perhatikan Cara Menyampaikan Laporan Yang Baik dan Benar
                <span class="w-5 h-5 flex items-center justify-center rounded border border-[#a51a39] text-[#a51a39] text-xs cursor-pointer">
                    ?
                </span>
            </p>
        </div>

        <div class="mb-5">
            <input
                type="text"
                name="judul"
                placeholder="Ketik judul laporan Anda *"
                class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-[#C70D3C] focus:ring-2 focus:ring-red-100 outline-none transition"
                value="{{ old('judul') }}"
                required
            >
        </div>

        <div class="mb-5">
            <textarea
                name="isi"
                placeholder="Ketik isi laporan anda secara detail *"
                rows="6"
                class="placeholder-gray-400 w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-[#C70D3C] focus:ring-2 focus:ring-red-100 outline-none transition"
                required
            >{{ old('isi') }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-5">
            <div class="relative w-full">
                <input
                    type="text"
                    id="tanggal"
                    name="tanggal"
                    placeholder="Pilih Tanggal Kejadian *"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-[#C70D3C] focus:ring-2 focus:ring-red-100 outline-none transition"
                    value="{{ old('tanggal') }}"
                    required
                >
                <div class="absolute top-0 right-0 h-full flex items-center px-3 bg-gray-100 border border-gray-300 rounded-r-lg">
                    <i class="fa-solid fa-calendar text-gray-600"></i>
                </div>
            </div>

            <div>
                <input
                    type="text"
                    name="lokasi"
                    placeholder="Ketik lokasi kejadian *"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-[#C70D3C] focus:ring-2 focus:ring-red-100 outline-none transition"
                    value="{{ old('lokasi') }}"
                    required
                >
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-5">
            <div>
                <input
                    type="text"
                    name="instansi"
                    placeholder="Ketik instansi tujuan (jika ada)"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-[#C70D3C] focus:ring-2 focus:ring-red-100 outline-none transition"
                    value="{{ old('instansi') }}"
                >
            </div>

            <div class="relative w-full">
                <select
                    name="kategori"
                    class="appearance-none w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-[#C70D3C] focus:ring-2 focus:ring-red-100 outline-none transition"
                    required
                >
                    <option value="" disabled selected hidden>Pilih kategori</option>

                    @foreach ($kategoris as $group => $items)
                        <optgroup label="{{ $group }}">
                            @foreach ($items as $value => $label)
                            <option value="{{ $value }}" {{ old('kategori') == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>

                <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                    <i class="fa-solid fa-chevron-down text-gray-500 text-sm"></i>
                </div>
            </div>
        </div>

        <div class="mb-5">
            <div class="space-y-1">
                <div class="flex items-center justify-between flex-wrap gap-3 pt-4 border-t border-gray-100">

                    <div x-data="fileUpload()" class="space-y-2">
                        <input
                            x-ref="fileInput"
                            type="file"
                            name="lampiran[]"
                            accept=".pdf,.jpg,.png"
                            class="hidden"
                            multiple
                            x-on:change="handleFiles"
                            required
                        >

                        <template x-if="files.length">
                            <ul class="mt-2 space-y-1 text-xs text-gray-600">
                                <template x-for="(file, index) in files" :key="index">
                                    <li class="flex justify-between items-center gap-2 border p-2 rounded">
                                        <div class="flex items-center gap-2 min-w-0">
                                            <span
                                                class="truncate max-w-45 block"
                                                :title="file.name"
                                                x-text="file.name"
                                            ></span>
                                        </div>
                                        <div class="flex items-center gap-2 shrink-0">
                                            <span class="text-gray-500" x-text="(file.size / 1024).toFixed(1) + ' KB'"></span>
                                            <button
                                                type="button"
                                                x-on:click="removeFile(index)"
                                                class="text-[#a51a39] font-bold cursor-pointer"
                                            >
                                                <i class="fa-solid fa-close"></i>
                                            </button>
                                        </div>
                                    </li>
                                </template>
                            </ul>
                        </template>

                        <label
                            x-on:click="$refs.fileInput.click()"
                            class="flex items-center gap-2 px-3 py-2 text-sm text-gray-500 border border-gray-300 rounded-md cursor-pointer hover:border-gray-300 hover:text-gray-700 transition-all"
                        >
                            <i class="fa-solid fa-paperclip"></i>
                            Upload Lampiran
                        </label>

                        <p class="text-xs text-gray-400">
                            Maks. 2MB per file (.pdf, .jpg, .png)
                        </p>
                    </div>

                    <div class="flex items-center gap-4 flex-wrap">
                        <div>
                            <input type="hidden" name="anonim" value="0">
                            <label class="flex items-center gap-2 text-sm text-gray-500 cursor-pointer select-none">
                                <input
                                    type="checkbox"
                                    class="accent-[#a51a39] cursor-pointer"
                                    name="anonim"
                                    value="1"
                                    {{ old('anonim') ? 'checked' : '' }}
                                >
                                Anonim
                            </label>

                            <input type="hidden" name="rahasia" value="0">
                            <label class="flex items-center gap-2 text-sm text-gray-500 cursor-pointer select-none">
                                <input
                                    type="checkbox"
                                    class="accent-[#a51a39] cursor-pointer"
                                    name="rahasia"
                                    value="1"
                                    {{ old('rahasia') ? 'checked' : '' }}
                                >
                                Rahasia
                            </label>
                        </div>

                        <button type="button" onclick="confirmSubmit()" class="cursor-pointer px-6 py-2.5 bg-[#a51a39] text-white text-sm font-medium rounded-lg hover:bg-[#aa0b33] transition-all">
                            Lapor!
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </form>
</div>

<script>
function fileUpload() {
    return {
        files: [],

        handleFiles(event) {
            const selected = Array.from(event.target.files)
            this.files = [...this.files, ...selected]
            this.syncFilesToInput()
        },

        removeFile(index) {
            this.files.splice(index, 1)
            this.syncFilesToInput()
        },

        syncFilesToInput() {
            const dataTransfer = new DataTransfer()

            this.files.forEach(file => {
                dataTransfer.items.add(file)
            })

            this.$refs.fileInput.files = dataTransfer.files
        }
    }
}
</script>

<script>
function confirmSubmit() {
    const form = document.getElementById('formLaporan');

    // cek validasi dulu (required, dll)
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    Swal.fire({
        title: "Kirim laporan?",
        html: "Pastikan semua data sudah benar.<br>Laporan tidak bisa diubah setelah dikirim.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#a51a39",
        cancelButtonColor: "#aaa",
        confirmButtonText: "Ya, kirim!",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
</script>
