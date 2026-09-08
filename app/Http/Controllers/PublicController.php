<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Report;
use App\Models\User;

class PublicController extends Controller
{
    // ── Data berita statis (bisa diganti DB di masa depan) ──────────────────
    private function beritaData(): array
    {
        return [
            [
                'slug'      => 'perbaikan-jalan-raya-subang',
                'judul'     => 'Perbaikan Jalan di Beberapa Titik Kota Subang Dimulai',
                'ringkasan' => 'Dinas PUPR Kabupaten Subang memulai perbaikan jalan di beberapa ruas yang rusak akibat cuaca ekstrem.',
                'isi'       => "Dinas Pekerjaan Umum dan Penataan Ruang (PUPR) Kabupaten Subang resmi memulai program perbaikan jalan di sejumlah titik yang mengalami kerusakan cukup parah.\n\nPerbaikan ini dilakukan sebagai respons atas banyaknya laporan dari masyarakat melalui aplikasi SAPAsubang dan laporan langsung ke kantor dinas. Total ada 12 titik yang akan diperbaiki dalam tahap pertama.\n\n\"Kami menargetkan perbaikan selesai dalam waktu 3 minggu ke depan,\" ujar Kepala Dinas PUPR Subang.\n\nMasyarakat diimbau untuk berhati-hati melintas di area perbaikan dan tetap aktif melaporkan kerusakan infrastruktur melalui aplikasi SAPAsubang.",
                'kategori'  => 'Infrastruktur',
                'tanggal'   => '2 Sep 2026',
                'icon'      => '🛣️',
                'foto'      => 'https://images.unsplash.com/photo-1573649601518-e4b94ba0db52?w=600&q=80',
                'gradient'  => 'from-orange-100 to-yellow-100',
            ],
            [
                'slug'      => 'program-pengelolaan-sampah-subang',
                'judul'     => 'Program Pengelolaan Sampah Terpadu Kota Subang Resmi Diluncurkan',
                'ringkasan' => 'Pemkab Subang meluncurkan program pengelolaan sampah terpadu untuk mengatasi masalah sampah liar.',
                'isi'       => "Pemerintah Kabupaten Subang secara resmi meluncurkan Program Pengelolaan Sampah Terpadu yang bertujuan mengurangi volume sampah liar di seluruh wilayah kabupaten.\n\nProgram ini mencakup penambahan armada pengangkut sampah, pembangunan TPS3R (Tempat Pengolahan Sampah Reuse, Reduce, Recycle), serta edukasi masyarakat tentang pemilahan sampah dari rumah.\n\nMasyarakat juga dapat melaporkan titik-titik sampah liar melalui aplikasi SAPAsubang agar dapat segera ditangani petugas kebersihan.",
                'kategori'  => 'Lingkungan',
                'tanggal'   => '1 Sep 2026',
                'icon'      => '♻️',
                'foto'      => 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?w=600&q=80',
                'gradient'  => 'from-green-100 to-teal-100',
            ],
            [
                'slug'      => 'normalisasi-sungai-cilamaya',
                'judul'     => 'Normalisasi Sungai Cilamaya untuk Cegah Banjir Musim Hujan',
                'ringkasan' => 'Proyek normalisasi Sungai Cilamaya resmi dimulai untuk mencegah banjir di musim hujan mendatang.',
                'isi'       => "Pemerintah Kabupaten Subang bersama Balai Besar Wilayah Sungai (BBWS) Citarum memulai proyek normalisasi Sungai Cilamaya sepanjang 15 kilometer.\n\nProyek ini diharapkan dapat mengurangi risiko banjir yang kerap melanda permukiman warga di bantaran sungai setiap musim hujan. Selain normalisasi, akan dilakukan juga pembangunan tanggul pengaman di beberapa titik rawan.",
                'kategori'  => 'Infrastruktur',
                'tanggal'   => '30 Ags 2026',
                'icon'      => '🌊',
                'foto'      => 'https://images.unsplash.com/photo-1518173946687-a4c8892bbd9f?w=600&q=80',
                'gradient'  => 'from-blue-100 to-cyan-100',
            ],
            [
                'slug'      => 'lampu-jalan-led-subang',
                'judul'     => 'Pemkab Subang Ganti 2.000 Lampu Jalan Konvensional dengan LED',
                'ringkasan' => 'Untuk menghemat energi dan meningkatkan keamanan, pemkab mulai mengganti lampu jalan dengan LED.',
                'isi'       => "Dinas Perhubungan Kabupaten Subang mulai melaksanakan program penggantian 2.000 lampu jalan konvensional dengan lampu LED hemat energi di seluruh wilayah kabupaten.\n\nProgram ini merupakan bagian dari Smart City Subang yang bertujuan meningkatkan efisiensi energi sekaligus meningkatkan keamanan dan kenyamanan masyarakat saat beraktivitas di malam hari.",
                'kategori'  => 'Fasilitas Umum',
                'tanggal'   => '28 Ags 2026',
                'icon'      => '💡',
                'foto'      => 'https://images.unsplash.com/photo-1514890547357-a9ee288728e0?w=600&q=80',
                'gradient'  => 'from-yellow-100 to-amber-100',
            ],
            [
                'slug'      => 'aplikasi-sapasubang-diluncurkan',
                'judul'     => 'Aplikasi SAPAsubang Resmi Diluncurkan untuk Permudah Pelaporan Masyarakat',
                'ringkasan' => 'Pemkab Subang meluncurkan SAPAsubang, platform digital pelaporan masalah fasilitas umum berbasis GPS.',
                'isi'       => "Pemerintah Kabupaten Subang resmi meluncurkan aplikasi SAPAsubang (Sistem Aduan & Pelaporan Aspirasi Subang), sebuah platform digital yang memudahkan masyarakat melaporkan permasalahan fasilitas umum.\n\nDengan aplikasi ini, masyarakat dapat melaporkan masalah seperti jalan rusak, lampu jalan mati, sampah menumpuk, banjir, dan kerusakan fasilitas umum hanya dengan memfoto masalah, dan sistem akan otomatis mendeteksi lokasi via GPS.\n\n\"Kami berharap dengan adanya SAPAsubang, respons pemerintah terhadap masalah di lapangan bisa lebih cepat dan transparan,\" ujar Bupati Subang.",
                'kategori'  => 'Teknologi',
                'tanggal'   => '25 Ags 2026',
                'icon'      => '📱',
                'foto'      => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=600&q=80',
                'gradient'  => 'from-purple-100 to-indigo-100',
            ],
        ];
    }

    // ── HOME ──────────────────────────────────────────────────────────────────
    public function home()
    {
        $stats = [
            'total'   => Report::count(),
            'selesai' => Report::where('status', 'selesai')->count(),
            'proses'  => Report::whereIn('status', ['terverifikasi','ditugaskan','menuju_lokasi','sedang_ditangani','menunggu_konfirmasi'])->count(),
            'pelapor' => User::where('role', 'user')->count(),
        ];

        $berita = array_slice($this->beritaData(), 0, 3);

        $laporanTerbaru = Report::with('category')
            ->whereNotIn('status', ['ditolak'])
            ->withCount('supports')
            ->orderByDesc('created_at')
            ->take(6)
            ->get();

        // Data peta untuk halaman home — koordinat Kabupaten Subang yang benar
        $mapPoints = Report::with('category')
            ->whereNotIn('status', ['ditolak'])
            ->get()
            ->map(fn($r) => [
                'kode'         => $r->kode_laporan,
                'lat'          => $r->latitude,
                'lng'          => $r->longitude,
                'status'       => $r->status,
                'status_label' => Report::$statusLabels[$r->status] ?? $r->status,
                'kategori'     => $r->category->nama_kategori,
            ])->values();

        return view('home', compact('stats', 'berita', 'laporanTerbaru', 'mapPoints'));
    }

    // ── TENTANG ───────────────────────────────────────────────────────────────
    public function tentang()
    {
        return view('tentang');
    }

    // ── BERITA INDEX ──────────────────────────────────────────────────────────
    public function berita()
    {
        $berita = $this->beritaData();
        return view('berita.index', compact('berita'));
    }

    // ── BERITA SHOW ───────────────────────────────────────────────────────────
    public function beritaShow(string $slug)
    {
        $all    = $this->beritaData();
        $berita = collect($all)->firstWhere('slug', $slug);

        if (!$berita) abort(404);

        $lainnya = collect($all)->where('slug', '!=', $slug)->take(3)->values()->toArray();

        return view('berita.show', compact('berita', 'lainnya'));
    }

    // ── LAPORAN PUBLIK ────────────────────────────────────────────────────────
    public function laporanPublik()
    {
        $categories = Category::where('aktif', true)->withCount('reports')->orderBy('nama_kategori')->get();

        $query = Report::with('category', 'supports')
            ->withCount('supports')
            ->whereNotIn('status', ['ditolak']);

        if (request('kategori')) {
            $query->where('category_id', request('kategori'));
        }

        $reports = $query->orderByDesc('created_at')->paginate(10);

        // Stats untuk sidebar
        $stats = [
            'total'   => Report::count(),
            'selesai' => Report::where('status', 'selesai')->count(),
            'proses'  => Report::whereIn('status', ['terverifikasi','ditugaskan','menuju_lokasi','sedang_ditangani','menunggu_konfirmasi'])->count(),
        ];

        // Data peta — koordinat Kabupaten Subang yang benar
        $mapPoints = Report::with('category')
            ->whereNotIn('status', ['ditolak'])
            ->get()
            ->map(fn($r) => [
                'kode'         => $r->kode_laporan,
                'lat'          => $r->latitude,
                'lng'          => $r->longitude,
                'status'       => $r->status,
                'status_label' => Report::$statusLabels[$r->status] ?? $r->status,
                'kategori'     => $r->category->nama_kategori,
            ])->values();

        return view('laporan.publik', compact('reports', 'categories', 'mapPoints', 'stats'));
    }
}
