@php
$stories = [
    [
        'title' => 'SIINas',
        'desc' => 'Menanyakan cara pengisian SIINas',
        'name' => 'Siti Malikhah',
    ],
    [
        'title' => 'Informasi Magang Karantina',
        'desc' => 'Apakah bisa untuk magang PKL dari Universitas Brawijaya, Prodi Budidaya Perairan',
        'name' => 'Hasna Nuranisa Ipnia Putri',
    ],
    [
        'title' => 'Ikan Nyuci Piring',
        'desc' => 'Izin lapor saluran air di walahar tembusan dari sungai citarum...',
        'name' => 'Andrew Frederick',
    ],
];
@endphp

<section class="py-32 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4">

        <h2 class="text-3xl font-bold text-gray-800">
            Kisah <span class="text-red-600">Sukses</span>
        </h2>

        <div class="grid md:grid-cols-3 gap-6 mt-10">

            @foreach ($stories as $story)
                <div class="relative overflow-hidden bg-white rounded-xl shadow-sm border border-gray-300 p-8 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">

                    <div class="space-y-3">

                        <h3 class="text-lg font-semibold text-gray-800">
                            <a href="#">{{ $story['title'] }}</a>
                        </h3>

                        <p class="text-sm text-gray-500">
                            {{ $story['desc'] }}
                        </p>

                        <div class="flex items-center gap-2 pt-2">
                            <img src="https://www.lapor.go.id/themes/lapor/assets/images/user-placeholder-m.png"
                                 class="w-8 h-8 rounded-full">

                            <a href="#" class="text-sm text-blue-600 hover:underline">
                                {{ $story['name'] }}
                            </a>
                        </div>

                    </div>

                    <div class="flex justify-between pt-18 text-sm text-gray-500">
                        <div class="flex gap-4">
                            <span><i class="fa-regular fa-comment"></i> 0 Komentar</span>
                            <span><i class="fa-regular fa-thumbs-up"></i> 0 Dukungan</span>
                        </div>
                    </div>

                    <img src="https://www.lapor.go.id/themes/lapor/assets/images/icon-finish.png"
                         class="absolute -bottom-4 right-2 w-28 opacity-60 -rotate-12">

                </div>
            @endforeach

        </div>

        <div class="text-center mt-10">
            <a href="#"
               class="inline-block font-bold px-8 py-3 border border-red-500 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition">
                BACA SELENGKAPNYA
            </a>
        </div>

    </div>
</section>
