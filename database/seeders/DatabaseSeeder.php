<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Notification;
use App\Models\Officer;
use App\Models\Report;
use App\Models\ReportEvidence;
use App\Models\ReportStatusLog;
use App\Models\ReportSupport;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Kategori ────────────────────────────────────────────────────────────
        $categories = [
            ['nama_kategori' => 'Jalan Rusak',          'icon' => '🛣️',  'deskripsi' => 'Kerusakan jalan, lubang, atau permukaan jalan yang membahayakan'],
            ['nama_kategori' => 'Sampah Menumpuk',       'icon' => '🗑️',  'deskripsi' => 'Tumpukan sampah liar di area publik'],
            ['nama_kategori' => 'Banjir',                'icon' => '🌊',  'deskripsi' => 'Genangan air atau banjir yang mengganggu aktivitas'],
            ['nama_kategori' => 'Lampu Jalan Mati',      'icon' => '💡',  'deskripsi' => 'Lampu penerangan jalan yang tidak berfungsi'],
            ['nama_kategori' => 'Fasilitas Umum Rusak',  'icon' => '🏚️',  'deskripsi' => 'Kerusakan fasilitas umum seperti taman, bangku, halte, dll'],
            ['nama_kategori' => 'Saluran Air Tersumbat', 'icon' => '🚿',  'deskripsi' => 'Selokan atau saluran drainase yang tersumbat'],
        ];

        foreach ($categories as $cat) {
            Category::create(array_merge($cat, ['aktif' => true]));
        }

        // ── Admin ────────────────────────────────────────────────────────────────
        $admin = User::create([
            'name'     => 'Admin LaporIn',
            'email'    => 'admin@laporin.id',
            'password' => Hash::make('password'),
            'role'     => 'admin',
            'no_hp'    => '081200000001',
            'is_super_admin' => true,
        ]);

        // ── Petugas ──────────────────────────────────────────────────────────────
        $petugas1 = User::create([
            'name'     => 'Budi Santoso',
            'email'    => 'budi@laporin.id',
            'password' => Hash::make('password'),
            'role'     => 'petugas',
            'no_hp'    => '081200000002',
        ]);
        Officer::create([
            'user_id'               => $petugas1->id,
            'spesialisasi_kategori' => [1, 3, 6],
            'status_aktif'          => true,
        ]);

        $petugas2 = User::create([
            'name'     => 'Siti Rahayu',
            'email'    => 'siti@laporin.id',
            'password' => Hash::make('password'),
            'role'     => 'petugas',
            'no_hp'    => '081200000003',
        ]);
        Officer::create([
            'user_id'               => $petugas2->id,
            'spesialisasi_kategori' => [2, 4, 5],
            'status_aktif'          => true,
        ]);

        // ── User biasa ────────────────────────────────────────────────────────────
        $user1 = User::create([
            'name'     => 'Ahmad Fauzi',
            'email'    => 'ahmad@example.com',
            'password' => Hash::make('password'),
            'role'     => 'user',
            'no_hp'    => '081200000004',
        ]);

        $user2 = User::create([
            'name'     => 'Dewi Lestari',
            'email'    => 'dewi@example.com',
            'password' => Hash::make('password'),
            'role'     => 'user',
            'no_hp'    => '081200000005',
        ]);

        $user3 = User::create([
            'name'     => 'Rizky Pratama',
            'email'    => 'rizky@example.com',
            'password' => Hash::make('password'),
            'role'     => 'user',
            'no_hp'    => '081200000006',
        ]);

        // ── Laporan dengan berbagai status ────────────────────────────────────────

        $r1 = Report::create([
            'kode_laporan' => 'LP-20260901-0001',
            'user_id'      => $user1->id,
            'category_id'  => 1,
            'foto_sebelum' => 'demo/jalan-rusak.jpg',
            'latitude'     => -6.5640,
            'longitude'    => 107.7634,
            'deskripsi'    => 'Jalan berlubang besar di depan pasar, membahayakan pengendara motor.',
            'status'       => 'selesai',
            'prioritas'    => 'tinggi',
            'admin_id'     => $admin->id,
            'petugas_id'   => $petugas1->id,
        ]);
        ReportStatusLog::create(['report_id' => $r1->id, 'status_lama' => null, 'status_baru' => 'menunggu_verifikasi', 'diubah_oleh' => $user1->id]);
        ReportStatusLog::create(['report_id' => $r1->id, 'status_lama' => 'menunggu_verifikasi', 'status_baru' => 'terverifikasi', 'diubah_oleh' => $admin->id, 'catatan' => 'Laporan valid, prioritas tinggi']);
        ReportStatusLog::create(['report_id' => $r1->id, 'status_lama' => 'terverifikasi', 'status_baru' => 'ditugaskan', 'diubah_oleh' => $admin->id]);
        ReportStatusLog::create(['report_id' => $r1->id, 'status_lama' => 'ditugaskan', 'status_baru' => 'menuju_lokasi', 'diubah_oleh' => $petugas1->id]);
        ReportStatusLog::create(['report_id' => $r1->id, 'status_lama' => 'menuju_lokasi', 'status_baru' => 'sedang_ditangani', 'diubah_oleh' => $petugas1->id]);
        ReportStatusLog::create(['report_id' => $r1->id, 'status_lama' => 'sedang_ditangani', 'status_baru' => 'menunggu_konfirmasi', 'diubah_oleh' => $petugas1->id]);
        ReportStatusLog::create(['report_id' => $r1->id, 'status_lama' => 'menunggu_konfirmasi', 'status_baru' => 'selesai', 'diubah_oleh' => $admin->id, 'catatan' => 'Perbaikan sudah sesuai standar']);
        ReportEvidence::create(['report_id' => $r1->id, 'foto_sesudah' => 'demo/jalan-sesudah.jpg', 'keterangan_pekerjaan' => 'Lubang telah ditambal dengan aspal beton grade A.', 'petugas_id' => $petugas1->id]);
        ReportSupport::create(['report_id' => $r1->id, 'user_id' => $user2->id]);
        ReportSupport::create(['report_id' => $r1->id, 'user_id' => $user3->id]);
        Notification::kirim($user1->id, 'Laporan Selesai', 'Laporan LP-20260901-0001 yang Anda buat sudah diselesaikan.', $r1->id);
        Notification::kirim($user2->id, 'Laporan yang Anda Dukung Selesai', 'Laporan LP-20260901-0001 yang Anda dukung sudah diselesaikan.', $r1->id);
        Notification::kirim($user3->id, 'Laporan yang Anda Dukung Selesai', 'Laporan LP-20260901-0001 yang Anda dukung sudah diselesaikan.', $r1->id);

        $r2 = Report::create([
            'kode_laporan' => 'LP-20260902-0001',
            'user_id'      => $user2->id,
            'category_id'  => 2,
            'foto_sebelum' => 'demo/sampah.jpg',
            'latitude'     => -6.5720,
            'longitude'    => 107.7510,
            'deskripsi'    => 'Sampah menumpuk di pinggir jalan sejak 3 hari lalu, bau tidak sedap.',
            'status'       => 'sedang_ditangani',
            'prioritas'    => 'sedang',
            'admin_id'     => $admin->id,
            'petugas_id'   => $petugas2->id,
        ]);
        ReportStatusLog::create(['report_id' => $r2->id, 'status_lama' => null, 'status_baru' => 'menunggu_verifikasi', 'diubah_oleh' => $user2->id]);
        ReportStatusLog::create(['report_id' => $r2->id, 'status_lama' => 'menunggu_verifikasi', 'status_baru' => 'terverifikasi', 'diubah_oleh' => $admin->id]);
        ReportStatusLog::create(['report_id' => $r2->id, 'status_lama' => 'terverifikasi', 'status_baru' => 'ditugaskan', 'diubah_oleh' => $admin->id]);
        ReportStatusLog::create(['report_id' => $r2->id, 'status_lama' => 'ditugaskan', 'status_baru' => 'menuju_lokasi', 'diubah_oleh' => $petugas2->id]);
        ReportStatusLog::create(['report_id' => $r2->id, 'status_lama' => 'menuju_lokasi', 'status_baru' => 'sedang_ditangani', 'diubah_oleh' => $petugas2->id]);
        ReportSupport::create(['report_id' => $r2->id, 'user_id' => $user1->id]);
        Notification::kirim($petugas2->id, 'Tugas Baru', 'Anda ditugaskan menangani laporan LP-20260902-0001 (Sampah Menumpuk).', $r2->id);

        $r3 = Report::create([
            'kode_laporan' => 'LP-20260903-0001',
            'user_id'      => $user3->id,
            'category_id'  => 4,
            'foto_sebelum' => 'demo/lampu-mati.jpg',
            'latitude'     => -6.5580,
            'longitude'    => 107.8020,
            'deskripsi'    => 'Lampu jalan di RT 05 sudah mati selama seminggu, gelap sekali malam hari.',
            'status'       => 'menunggu_verifikasi',
            'prioritas'    => null,
            'admin_id'     => null,
            'petugas_id'   => null,
        ]);
        ReportStatusLog::create(['report_id' => $r3->id, 'status_lama' => null, 'status_baru' => 'menunggu_verifikasi', 'diubah_oleh' => $user3->id]);

        $r4 = Report::create([
            'kode_laporan'  => 'LP-20260903-0002',
            'user_id'       => $user1->id,
            'category_id'   => 3,
            'foto_sebelum'  => 'demo/banjir.jpg',
            'latitude'      => -6.5400,
            'longitude'     => 107.7800,
            'deskripsi'     => 'Ada genangan air di halaman rumah saya.',
            'status'        => 'ditolak',
            'prioritas'     => null,
            'admin_id'      => $admin->id,
            'alasan_ditolak'=> 'Laporan tidak memenuhi kriteria — genangan di pekarangan pribadi bukan fasilitas umum.',
        ]);
        ReportStatusLog::create(['report_id' => $r4->id, 'status_lama' => null, 'status_baru' => 'menunggu_verifikasi', 'diubah_oleh' => $user1->id]);
        ReportStatusLog::create(['report_id' => $r4->id, 'status_lama' => 'menunggu_verifikasi', 'status_baru' => 'ditolak', 'diubah_oleh' => $admin->id, 'catatan' => 'Bukan fasilitas umum']);
        Notification::kirim($user1->id, 'Laporan Ditolak', 'Laporan LP-20260903-0002 ditolak: Laporan tidak memenuhi kriteria — genangan di pekarangan pribadi bukan fasilitas umum.', $r4->id);

        $r5 = Report::create([
            'kode_laporan' => 'LP-20260904-0001',
            'user_id'      => $user2->id,
            'category_id'  => 5,
            'foto_sebelum' => 'demo/halte-rusak.jpg',
            'latitude'     => -6.5810,
            'longitude'    => 107.7450,
            'deskripsi'    => 'Halte bus di Jl. Merdeka atapnya roboh, berbahaya bagi penumpang.',
            'status'       => 'menunggu_konfirmasi',
            'prioritas'    => 'darurat',
            'admin_id'     => $admin->id,
            'petugas_id'   => $petugas2->id,
        ]);
        ReportStatusLog::create(['report_id' => $r5->id, 'status_lama' => null, 'status_baru' => 'menunggu_verifikasi', 'diubah_oleh' => $user2->id]);
        ReportStatusLog::create(['report_id' => $r5->id, 'status_lama' => 'menunggu_verifikasi', 'status_baru' => 'terverifikasi', 'diubah_oleh' => $admin->id]);
        ReportStatusLog::create(['report_id' => $r5->id, 'status_lama' => 'terverifikasi', 'status_baru' => 'ditugaskan', 'diubah_oleh' => $admin->id]);
        ReportStatusLog::create(['report_id' => $r5->id, 'status_lama' => 'ditugaskan', 'status_baru' => 'menuju_lokasi', 'diubah_oleh' => $petugas2->id]);
        ReportStatusLog::create(['report_id' => $r5->id, 'status_lama' => 'menuju_lokasi', 'status_baru' => 'sedang_ditangani', 'diubah_oleh' => $petugas2->id]);
        ReportStatusLog::create(['report_id' => $r5->id, 'status_lama' => 'sedang_ditangani', 'status_baru' => 'menunggu_konfirmasi', 'diubah_oleh' => $petugas2->id]);
        ReportEvidence::create(['report_id' => $r5->id, 'foto_sesudah' => 'demo/halte-sesudah.jpg', 'keterangan_pekerjaan' => 'Atap halte telah diperbaiki dan diperkuat.', 'petugas_id' => $petugas2->id]);
        ReportSupport::create(['report_id' => $r5->id, 'user_id' => $user3->id]);
        Notification::kirim($admin->id, 'Bukti Pekerjaan Masuk', 'Petugas Siti Rahayu telah mengirim bukti penanganan LP-20260904-0001. Silakan periksa.', $r5->id);
    }
}
