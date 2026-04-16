<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Laporan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ========================
        // ADMIN
        // ========================
        User::create([
            'role' => 'admin',
            'nik' => '5101010101010001',
            'nama_lengkap' => 'Admin LADU Bali',
            'username' => 'admin',
            'email' => 'admin@ladu.id',
            'password' => 'admin123',
            'no_telepon' => '081234567890',
            'alamat' => 'Denpasar',
            'tanggal_lahir' => '1990-01-01',
            'jenis_kelamin' => 'L',
            'pekerjaan' => 'Administrator'
        ]);

        // ========================
        // USERS
        // ========================
        $users = [
            ['nama' => 'I Wayan Morgan', 'username' => 'morgan'],
            ['nama' => 'Ni Kadek Sulastri', 'username' => 'sulastri'],
            ['nama' => 'I Made Gacor', 'username' => 'made'],
            ['nama' => 'Ketut Santuy', 'username' => 'ketut'],
        ];

        $createdUsers = [];

        foreach ($users as $i => $u) {
            $createdUsers[] = User::create([
                'role' => 'user',
                'nik' => '510101010101000' . ($i + 2),
                'nama_lengkap' => $u['nama'],
                'username' => $u['username'],
                'email' => $u['username'] . '@ladu.id',
                'password' => 'password123',
                'no_telepon' => '08' . rand(111111111, 999999999),
                'alamat' => 'Bali',
                'tanggal_lahir' => '1995-01-01',
                'jenis_kelamin' => 'L',
                'pekerjaan' => 'Warga',
            ]);
        }

        // ========================
        // LAPORAN UTAMA (LUCU)
        // ========================
        $laporans = [
            [
                'judul' => 'Ayam Berkokok Jam 2 Pagi',
                'isi' => 'Ayam tetangga berkokok tiap jam 2 pagi seperti ada rapat penting.',
                'lokasi' => 'Denpasar',
                'instansi' => 'Dinas Peternakan',
                'kategori' => 'Lingkungan',
            ],
            [
                'judul' => 'Wifi Hilang Saat Hujan',
                'isi' => 'Setiap hujan turun, sinyal wifi ikut menghilang.',
                'lokasi' => 'Badung',
                'instansi' => 'Dinas Kominfo',
                'kategori' => 'Teknologi',
            ],
            [
                'judul' => 'Kucing Duduk Tengah Jalan',
                'isi' => 'Kucing sering duduk di tengah jalan dan tidak mau pindah.',
                'lokasi' => 'Gianyar',
                'instansi' => 'Dinas Ketertiban',
                'kategori' => 'Ketertiban',
            ],
            [
                'judul' => 'Knalpot Lebih Kencang dari Gamelan',
                'isi' => 'Suara knalpot seperti konser tiap pagi.',
                'lokasi' => 'Tabanan',
                'instansi' => 'Dinas Perhubungan',
                'kategori' => 'Transportasi',
            ],
            [
                'judul' => 'Lampu Jalan Nyala Siang',
                'isi' => 'Lampu jalan aktif siang dan mati malam.',
                'lokasi' => 'Sanur',
                'instansi' => 'Dinas PUPR',
                'kategori' => 'Infrastruktur',
            ],
            [
                'judul' => 'Parkir Motor Kayak Tetris',
                'isi' => 'Parkir terlalu sempit, perlu skill khusus.',
                'lokasi' => 'Denpasar',
                'instansi' => 'Dinas Perhubungan',
                'kategori' => 'Fasilitas',
            ],
            [
                'judul' => 'Anjing Overprotective',
                'isi' => 'Anjing menggonggong ke semua orang termasuk pemilik.',
                'lokasi' => 'Ubud',
                'instansi' => 'Dinas Ketertiban',
                'kategori' => 'Keamanan',
            ],
            [
                'judul' => 'Sampah Hilang Misterius',
                'isi' => 'Sampah sering hilang sebelum diangkut.',
                'lokasi' => 'Denpasar',
                'instansi' => 'Dinas Kebersihan',
                'kategori' => 'Lingkungan',
            ],
        ];

        // ========================
        // TAMBAHAN 20 DATA (RAPI)
        // ========================
        $laporansTambahan = [
            ['judul'=>'Bebek Nyebrang Tanpa Lihat','isi'=>'Bebek menyebrang tanpa koordinasi.','lokasi'=>'Gianyar','instansi'=>'Dinas Ketertiban','kategori'=>'Ketertiban'],
            ['judul'=>'Warung Tutup Pas Lapar','isi'=>'Warung selalu tutup saat dibutuhkan.','lokasi'=>'Denpasar','instansi'=>'Dinas UMKM','kategori'=>'Pelayanan'],
            ['judul'=>'Parkir Tidak Beraturan','isi'=>'Parkir motor menyulitkan keluar masuk.','lokasi'=>'Badung','instansi'=>'Dishub','kategori'=>'Transportasi'],
            ['judul'=>'Antrian ATM Panjang','isi'=>'Antrian panjang tanpa kepastian.','lokasi'=>'Tabanan','instansi'=>'Pelayanan','kategori'=>'Pelayanan'],
            ['judul'=>'Lampu Merah Lama','isi'=>'Lampu merah terlalu lama.','lokasi'=>'Denpasar','instansi'=>'Dishub','kategori'=>'Transportasi'],
            ['judul'=>'Kucing di Motor','isi'=>'Kucing sering tidur di motor.','lokasi'=>'Ubud','instansi'=>'Ketertiban','kategori'=>'Lingkungan'],
            ['judul'=>'Ayam Lomba Kokok','isi'=>'Ayam berkokok bersamaan.','lokasi'=>'Gianyar','instansi'=>'Peternakan','kategori'=>'Lingkungan'],
            ['judul'=>'Wifi Lemot Deadline','isi'=>'Internet lambat saat deadline.','lokasi'=>'Denpasar','instansi'=>'Kominfo','kategori'=>'Teknologi'],
            ['judul'=>'Jalan Licin','isi'=>'Jalan licin setelah hujan.','lokasi'=>'Badung','instansi'=>'PUPR','kategori'=>'Infrastruktur'],
            ['judul'=>'Sampah Cepat Penuh','isi'=>'Tempat sampah cepat penuh.','lokasi'=>'Sanur','instansi'=>'Kebersihan','kategori'=>'Lingkungan'],
            ['judul'=>'Motor Ngebut Gang','isi'=>'Motor ngebut di gang kecil.','lokasi'=>'Denpasar','instansi'=>'Dishub','kategori'=>'Transportasi'],
            ['judul'=>'Lampu Kedip','isi'=>'Lampu jalan berkedip.','lokasi'=>'Tabanan','instansi'=>'PUPR','kategori'=>'Infrastruktur'],
            ['judul'=>'Trotoar Dipakai Jualan','isi'=>'Trotoar dipakai pedagang.','lokasi'=>'Denpasar','instansi'=>'Satpol PP','kategori'=>'Ketertiban'],
            ['judul'=>'Musik Keras Malam','isi'=>'Musik keras sampai malam.','lokasi'=>'Kuta','instansi'=>'Pariwisata','kategori'=>'Lingkungan'],
            ['judul'=>'Air Kecil','isi'=>'Aliran air kecil.','lokasi'=>'Gianyar','instansi'=>'PDAM','kategori'=>'Fasilitas'],
            ['judul'=>'Drainase Bau','isi'=>'Drainase bau tidak sedap.','lokasi'=>'Denpasar','instansi'=>'Kebersihan','kategori'=>'Lingkungan'],
            ['judul'=>'Mobil Parkir Sembarangan','isi'=>'Mobil ganggu jalan.','lokasi'=>'Badung','instansi'=>'Dishub','kategori'=>'Transportasi'],
            ['judul'=>'Trotoar Nongkrong','isi'=>'Trotoar dipakai nongkrong.','lokasi'=>'Denpasar','instansi'=>'Satpol PP','kategori'=>'Ketertiban'],
            ['judul'=>'Kabel Berantakan','isi'=>'Kabel terlihat berbahaya.','lokasi'=>'Tabanan','instansi'=>'PUPR','kategori'=>'Infrastruktur'],
            ['judul'=>'Antrian SPBU','isi'=>'Antrian panjang.','lokasi'=>'Denpasar','instansi'=>'Pertamina','kategori'=>'Pelayanan'],
        ];

        // ========================
        // INSERT SEMUA DATA
        // ========================
        foreach (array_merge($laporans, $laporansTambahan) as $lap) {
            Laporan::create([
                'user_id' => collect($createdUsers)->random()->id,
                'classification' => collect(['pengaduan','aspirasi'])->random(),
                'judul' => $lap['judul'],
                'isi' => $lap['isi'],
                'tanggal' => now()->subDays(rand(1, 10)),
                'lokasi' => $lap['lokasi'],
                'instansi' => $lap['instansi'],
                'kategori' => $lap['kategori'],
                'lampiran' => [
    'lampiran/1776354140_69e1035cee5d6_Screenshot 2026-04-05 125416.png'
],

                'anonim' => rand(0,1),
                'rahasia' => rand(0,1),
                'status' => collect(['pending','diproses','selesai'])->random(),
            ]);
        }
    }
}
