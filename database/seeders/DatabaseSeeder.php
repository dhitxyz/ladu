<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Laporan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        $admin = User::create([
            'role' => 'admin',
            'nik' => '1234567890123456',
            'nama_lengkap' => 'Admin LADU',
            'username' => 'admin',
            'email' => 'admin@ladu.com',
            'password' => 'admin123',
            'no_telepon' => '081234567890',
            'alamat' => 'Jakarta Pusat',
            'tanggal_lahir' => '1990-01-01',
            'jenis_kelamin' => 'L',
            'pekerjaan' => 'Administrator'
        ]);

        // Create Regular Users
        $user1 = User::create([
            'role' => 'user',
            'nik' => '1234567890123457',
            'nama_lengkap' => 'Budi Santoso',
            'username' => 'budi',
            'email' => 'budi@example.com',
            'password' => 'password123',
            'no_telepon' => '082345678901',
            'alamat' => 'Jakarta Timur',
            'tanggal_lahir' => '1995-03-15',
            'jenis_kelamin' => 'L',
            'pekerjaan' => 'Guru'
        ]);

        $user2 = User::create([
            'role' => 'user',
            'nik' => '1234567890123458',
            'nama_lengkap' => 'Siti Nurhaliza',
            'username' => 'siti',
            'email' => 'siti@example.com',
            'password' => 'password123',
            'no_telepon' => '082345678902',
            'alamat' => 'Jakarta Barat',
            'tanggal_lahir' => '1992-07-22',
            'jenis_kelamin' => 'P',
            'pekerjaan' => 'Nurse'
        ]);

        $user3 = User::create([
            'role' => 'user',
            'nik' => '1234567890123459',
            'nama_lengkap' => 'Ahmad Hidayat',
            'username' => 'ahmad',
            'email' => 'ahmad@example.com',
            'password' => 'password123',
            'no_telepon' => '082345678903',
            'alamat' => 'Jakarta Selatan',
            'tanggal_lahir' => '1998-05-10',
            'jenis_kelamin' => 'L',
            'pekerjaan' => 'Wiraswasta'
        ]);

        // Create Sample Laporans
        Laporan::create([
            'user_id' => $user1->id,
            'classification' => 'pengaduan',
            'judul' => 'Lampu jalan di Jln. Sudirman mati',
            'isi' => 'Lampu jalan sepanjang Jln. Sudirman blok C-D tidak menyala selama 3 hari. Ini sangat mengganggu keselamatan pengendara motor di malam hari.',
            'tanggal' => '2026-04-15',
            'lokasi' => 'Jln. Sudirman, Jakarta Timur',
            'instansi' => 'Dinas Pekerjaan Umum',
            'kategori' => 'Infrastruktur Jalan',
            'anonim' => false,
            'rahasia' => false,
            'status' => 'pending'
        ]);

        Laporan::create([
            'user_id' => $user2->id,
            'classification' => 'pengaduan',
            'judul' => 'Sampah menumpuk di sudut kompleks',
            'isi' => 'Sampah di sudut kompleks Raya Permata tidak pernah diambil. Sudah menumpuk selama seminggu dan menimbulkan bau yang menyengat.',
            'tanggal' => '2026-04-14',
            'lokasi' => 'Kompleks Raya Permata, Jakarta Barat',
            'instansi' => 'Dinas Kebersihan',
            'kategori' => 'Kebersihan Lingkungan',
            'anonim' => false,
            'rahasia' => false,
            'status' => 'diproses'
        ]);

        Laporan::create([
            'user_id' => $user3->id,
            'classification' => 'pengaduan',
            'judul' => 'Pothole di jalan protokol',
            'isi' => 'Ada lubang besar di jalan protokol yang berbahaya bagi pengendara. Sudah menyebabkan beberapa kecelakaan ringan.',
            'tanggal' => '2026-04-12',
            'lokasi' => 'Jln. Protokol, Jakarta Selatan',
            'instansi' => 'Dinas Pekerjaan Umum',
            'kategori' => 'Infrastruktur Jalan',
            'anonim' => false,
            'rahasia' => false,
            'status' => 'selesai'
        ]);

        Laporan::create([
            'user_id' => $user1->id,
            'classification' => 'aspirasi',
            'judul' => 'Perlu penambahan tempat parkir umum',
            'isi' => 'Area toko dan pusat perbelanjaan di sekitar Jln. Merdeka sangat kekurangan tempat parkir. Diharapkan dapat menambah fasilitas parkir multi-level.',
            'tanggal' => '2026-04-13',
            'lokasi' => 'Jln. Merdeka, Jakarta Pusat',
            'instansi' => 'Dinas Perhubungan',
            'kategori' => 'Fasilitas Publik',
            'anonim' => true,
            'rahasia' => false,
            'status' => 'pending'
        ]);

        Laporan::create([
            'user_id' => $user2->id,
            'classification' => 'pengaduan',
            'judul' => 'Kantor cabang tidak responsif',
            'isi' => 'Kantor dinas di Jln. Gatot Subroto tidak responsif terhadap keluhan masyarakat. Setiap kali datang selalu bilang "nanti diurus".',
            'tanggal' => '2026-04-10',
            'lokasi' => 'Jln. Gatot Subroto, Jakarta Selatan',
            'instansi' => 'Dinas Sosial',
            'kategori' => 'Pelayanan Publik',
            'anonim' => true,
            'rahasia' => true,
            'status' => 'selesai'
        ]);

        Laporan::create([
            'user_id' => $user3->id,
            'classification' => 'informasi',
            'judul' => 'Permintaan data pembangunan proyek',
            'isi' => 'Permintaan informasi mengenai rencana pembangunan proyek infrastruktur baru di kawasan Timur Jakarta.',
            'tanggal' => '2026-04-11',
            'lokasi' => 'Jakarta Timur',
            'instansi' => 'Bappeda DKI',
            'kategori' => 'Pembangunan',
            'anonim' => false,
            'rahasia' => false,
            'status' => 'diproses'
        ]);
    }
}
