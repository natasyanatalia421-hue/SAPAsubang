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
                'slug'          => 'apel-besar-disiplin-pelayanan-publik',
                'judul'         => 'Pemkot Subang Gelar Apel Besar Perkuat Disiplin dan Pelayanan Publik',
                'ringkasan'     => 'Pemerintah kota menggelar apel besar yang diikuti seluruh OPD, ASN, dan tenaga fasilitator sebagai bentuk komitmen bersama untuk meningkatkan inspirasi, profesionalisme, dan aktualisasi sebagai warga masyarakat.',
                'isi'           => "Pemerintah Kota Subang menggelar apel besar yang diikuti seluruh OPD, ASN, dan tenaga fasilitator sebagai bentuk komitmen bersama untuk meningkatkan disiplin dan kualitas pelayanan publik.\n\nDalam apel tersebut, Wali Kota Subang menegaskan pentingnya integritas dan profesionalisme setiap aparatur pemerintah dalam melayani masyarakat.",
                'kategori'      => 'Pemerintahan',
                'kategori_slug' => 'pemerintahan',
                'warna'         => '#1d4ed8',
                'tanggal'       => '12 Sep 2025',
                'foto'          => '',
                'gradient'      => 'from-blue-100 to-indigo-100',
                'icon'          => '🏛️',
            ],
            [
                'slug'          => 'infrastruktur-jalan-subang-cikaum',
                'judul'         => 'Pembangunan Infrastruktur Jalan Ruas Subang-Cikaum Capai 70%',
                'ringkasan'     => 'Progres pembangunan jalan ruas Subang-Cikaum saat ini telah mencapai 70%. Pemerintah daerah bekerja keras untuk menyelesaikan proyek ini sesuai dengan target yang ditetapkan.',
                'isi'           => "Pembangunan infrastruktur jalan ruas Subang-Cikaum terus berjalan dengan progres mencapai 70%. Proyek ini merupakan bagian dari program pembangunan infrastruktur daerah.\n\nDitargetkan selesai pada akhir tahun 2025, pembangunan jalan ini akan meningkatkan konektivitas antar wilayah di Kabupaten Subang.",
                'kategori'      => 'Pembangunan',
                'kategori_slug' => 'pembangunan',
                'warna'         => '#d97706',
                'tanggal'       => '10 Sep 2025',
                'foto'          => '',
                'gradient'      => 'from-orange-100 to-yellow-100',
                'icon'          => '🔧',
            ],
            [
                'slug'          => 'smpn3-raih-juara-olimpiade-sains',
                'judul'         => 'SMPN 3 Subang Raih Juara 1 Olimpiade Sains Tingkat Jawa Barat',
                'ringkasan'     => 'SMPN 3 Subang berhasil meraih juara 1 dalam Olimpiade Sains Tingkat Jawa Barat. Prestasi ini membanggakan bagi seluruh warga sekolah dan Kabupaten Subang.',
                'isi'           => "SMPN 3 Subang kembali menorehkan prestasi gemilang dengan meraih juara 1 dalam Olimpiade Sains Tingkat Jawa Barat.\n\nPrestasi ini merupakan hasil kerja keras siswa dan pembinaan intensif dari para guru.",
                'kategori'      => 'Pendidikan',
                'kategori_slug' => 'pendidikan',
                'warna'         => '#7c3aed',
                'tanggal'       => '8 Sep 2025',
                'foto'          => '',
                'gradient'      => 'from-purple-100 to-indigo-100',
                'icon'          => '🎓',
            ],
            [
                'slug'          => 'gerakan-bersih-sungai-cijalu',
                'judul'         => 'Gerakan Bersih Sungai Cijalu, Wujudkan Subang Lebih Hijau',
                'ringkasan'     => 'Pemerintah bersama masyarakat menggelar kegiatan bersih sungai Cijalu sebagai langkah nyata menjaga kelestarian lingkungan dan mewujudkan Subang yang lebih hijau dan sehat.',
                'isi'           => "Gerakan bersih Sungai Cijalu digelar sebagai upaya bersama untuk menjaga kelestarian alam dan kebersihan lingkungan di Kabupaten Subang.",
                'kategori'      => 'Lingkungan',
                'kategori_slug' => 'lingkungan',
                'warna'         => '#16a34a',
                'tanggal'       => '6 Sep 2025',
                'foto'          => '',
                'gradient'      => 'from-green-100 to-teal-100',
                'icon'          => '🌿',
            ],
            [
                'slug'          => 'festival-budaya-subang-2025',
                'judul'         => 'Festival Budaya Subang 2025 Sukses Digelar',
                'ringkasan'     => 'Ribuan masyarakat Kota Subang antusias dalam rangka Festival Budaya Subang 2025 yang menampilkan seni tradisional, parade budaya, dan UMKM lokal.',
                'isi'           => "Festival Budaya Subang 2025 berhasil digelar dengan meriah dan dihadiri ribuan pengunjung dari berbagai daerah.",
                'kategori'      => 'Pariwisata',
                'kategori_slug' => 'sosial',
                'warna'         => '#db2777',
                'tanggal'       => '4 Sep 2025',
                'foto'          => '',
                'gradient'      => 'from-pink-100 to-rose-100',
                'icon'          => '🎭',
            ],
            [
                'slug'          => 'umkm-subang-produk-unggulan',
                'judul'         => 'UMKM Subang Tunjukkan Produk Unggulan di Pameran Nasional',
                'ringkasan'     => 'Sejumlah pelaku UMKM asal Subang tampil memukau dalam pameran nasional, menampilkan berbagai produk unggulan seperti kuliner, kerajinan, dan olahan pertanian.',
                'isi'           => "Para pelaku UMKM dari Kabupaten Subang berhasil menampilkan produk-produk unggulan mereka di pameran nasional.",
                'kategori'      => 'Ekonomi',
                'kategori_slug' => 'ekonomi',
                'warna'         => '#0891b2',
                'tanggal'       => '2 Sep 2025',
                'foto'          => '',
                'gradient'      => 'from-cyan-100 to-blue-100',
                'icon'          => '📈',
            ],
            [
                'slug'          => 'penanaman-pohon-wisata-panarukan',
                'judul'         => 'Penanaman Pohon di Area Wisata Panarukan',
                'ringkasan'     => 'Pemerintah bersama komunitas lingkungan melaksanakan kegiatan penanaman pohon di kawasan wisata Panarukan untuk menjaga Wisata Panarukan.',
                'isi'           => "Kegiatan penanaman pohon di kawasan Wisata Panarukan dilaksanakan sebagai bagian dari program penghijauan Kabupaten Subang.",
                'kategori'      => 'Wisata',
                'kategori_slug' => 'lingkungan',
                'warna'         => '#16a34a',
                'tanggal'       => '31 Agu 2025',
                'foto'          => '',
                'gradient'      => 'from-green-100 to-emerald-100',
                'icon'          => '🌳',
            ],
            [
                'slug'          => 'posyandu-remaja-kecamatan',
                'judul'         => 'Dinas Kesehatan Gelar Posyandu Remaja di Seluruh Kecamatan',
                'ringkasan'     => 'Dinas Kesehatan Kota Subang menggelar kegiatan Posyandu Remaja di seluruh kecamatan sebagai upaya mendukung hidup sehat bagi generasi muda.',
                'isi'           => "Kegiatan Posyandu Remaja digelar secara serentak di seluruh kecamatan di Kabupaten Subang sebagai bentuk perhatian pemerintah terhadap kesehatan generasi muda.",
                'kategori'      => 'Kesehatan',
                'kategori_slug' => 'kesehatan',
                'warna'         => '#dc2626',
                'tanggal'       => '29 Agu 2025',
                'foto'          => '',
                'gradient'      => 'from-red-100 to-rose-100',
                'icon'          => '🏥',
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

    // ── WISATA ────────────────────────────────────────────────────────────────
    public function wisata()
    {
        return view('wisata');
    }

    // ── BERITA INDEX ──────────────────────────────────────────────────────────
    public function berita()
    {
        $all = $this->beritaData();

        // Filter berdasarkan kategori jika ada
        $kategoriFilter = request('kategori', 'semua');

        $berita = $kategoriFilter === 'semua'
            ? $all
            : array_values(array_filter($all, fn($b) => strtolower($b['kategori_slug'] ?? '') === $kategoriFilter));

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
            'total'    => Report::count(),
            'selesai'  => Report::where('status', 'selesai')->count(),
            'proses'   => Report::whereIn('status', ['terverifikasi','ditugaskan','menuju_lokasi','sedang_ditangani','menunggu_konfirmasi'])->count(),
            'menunggu' => Report::where('status', 'menunggu_verifikasi')->count(),
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
