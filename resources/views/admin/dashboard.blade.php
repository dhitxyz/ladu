<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    <!-- 🔴 Navbar -->
    <nav class="bg-red-600 text-white px-6 py-4 flex justify-between items-center shadow">
        <div class="flex items-center gap-2">
            <span class="text-2xl font-bold">LADU!</span>
        </div>

        <div class="flex items-center gap-6">
            <a href="#" class="hover:underline">Dashboard</a>
            <a href="#" class="hover:underline">Laporan</a>
            <a href="#" class="hover:underline">Statistik</a>

            <div class="flex items-center gap-2">
                <img src="https://i.pravatar.cc/30" class="rounded-full">
                <span>dodi</span>
            </div>
        </div>
    </nav>

    <!-- 🔴 Hero Background -->
    <div class="bg-red-600 h-40 relative">
        <div class="absolute inset-0 bg-gradient-to-r from-red-700 to-red-500 opacity-80"></div>
    </div>

    <!-- 🔴 Card Form -->
    <div class="max-w-3xl mx-auto -mt-20">
        <div class="bg-white rounded-xl shadow-lg p-6">

            <h2 class="bg-red-600 text-white px-4 py-2 rounded-md mb-4 font-semibold">
                Dashboard Admin
            </h2>

            <!-- 🔹 Statistik -->
            <div class="grid grid-cols-3 gap-4 mb-6">
                <div class="bg-gray-100 p-4 rounded-lg text-center">
                    <p class="text-gray-500 text-sm">Total Laporan</p>
                    <h3 class="text-2xl font-bold">120</h3>
                </div>

                <div class="bg-gray-100 p-4 rounded-lg text-center">
                    <p class="text-gray-500 text-sm">Diproses</p>
                    <h3 class="text-2xl font-bold text-yellow-500">45</h3>
                </div>

                <div class="bg-gray-100 p-4 rounded-lg text-center">
                    <p class="text-gray-500 text-sm">Selesai</p>
                    <h3 class="text-2xl font-bold text-green-500">75</h3>
                </div>
            </div>

            <!-- 🔹 Tabel Laporan -->
            <div>
                <h3 class="font-semibold mb-2">Laporan Terbaru</h3>

                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2">Judul</th>
                            <th class="p-2">Tanggal</th>
                            <th class="p-2">Status</th>
                            <th class="p-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td class="p-2">Jalan Rusak</td>
                            <td class="p-2">2026-04-16</td>
                            <td class="p-2 text-yellow-500">Diproses</td>
                            <td class="p-2">
                                <button class="bg-blue-500 text-white px-2 py-1 rounded text-xs">Detail</button>
                            </td>
                        </tr>

                        <tr class="border-b">
                            <td class="p-2">Lampu Mati</td>
                            <td class="p-2">2026-04-15</td>
                            <td class="p-2 text-green-500">Selesai</td>
                            <td class="p-2">
                                <button class="bg-blue-500 text-white px-2 py-1 rounded text-xs">Detail</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>
</html>