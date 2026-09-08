<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Report extends Model
{
    protected $fillable = [
        'kode_laporan', 'user_id', 'category_id', 'foto_sebelum',
        'latitude', 'longitude', 'deskripsi', 'status', 'prioritas',
        'admin_id', 'petugas_id', 'alasan_ditolak', 'catatan_revisi',
    ];

    protected function casts(): array
    {
        return [
            'latitude'  => 'float',
            'longitude' => 'float',
        ];
    }

    // Label status dalam Bahasa Indonesia
    public static array $statusLabels = [
        'menunggu_verifikasi'  => 'Menunggu Verifikasi',
        'ditolak'              => 'Ditolak',
        'terverifikasi'        => 'Terverifikasi',
        'ditugaskan'           => 'Ditugaskan',
        'menuju_lokasi'        => 'Menuju Lokasi',
        'sedang_ditangani'     => 'Sedang Ditangani',
        'menunggu_konfirmasi'  => 'Menunggu Konfirmasi Admin',
        'selesai'              => 'Selesai',
    ];

    public static array $statusColors = [
        'menunggu_verifikasi'  => 'yellow',
        'ditolak'              => 'red',
        'terverifikasi'        => 'blue',
        'ditugaskan'           => 'purple',
        'menuju_lokasi'        => 'indigo',
        'sedang_ditangani'     => 'orange',
        'menunggu_konfirmasi'  => 'cyan',
        'selesai'              => 'green',
    ];

    public static array $prioritasLabels = [
        'rendah'   => 'Rendah',
        'sedang'   => 'Sedang',
        'tinggi'   => 'Tinggi',
        'darurat'  => 'Darurat',
    ];

    public static array $prioritasColors = [
        'rendah'  => 'green',
        'sedang'  => 'yellow',
        'tinggi'  => 'orange',
        'darurat' => 'red',
    ];

    public function getStatusLabelAttribute(): string
    {
        return self::$statusLabels[$this->status] ?? $this->status;
    }

    public function getPrioritasLabelAttribute(): string
    {
        return self::$prioritasLabels[$this->prioritas] ?? '-';
    }

    // Hitung jumlah dukungan
    public function getSupportCountAttribute(): int
    {
        return $this->supports()->count();
    }

    // Relasi
    public function user(): BelongsTo     { return $this->belongsTo(User::class, 'user_id'); }
    public function category(): BelongsTo { return $this->belongsTo(Category::class, 'category_id'); }
    public function admin(): BelongsTo    { return $this->belongsTo(User::class, 'admin_id'); }
    public function petugas(): BelongsTo  { return $this->belongsTo(User::class, 'petugas_id'); }

    public function supports(): HasMany
    {
        return $this->hasMany(ReportSupport::class, 'report_id');
    }

    public function statusLogs(): HasMany
    {
        return $this->hasMany(ReportStatusLog::class, 'report_id')->orderBy('created_at');
    }

    public function evidence(): HasMany
    {
        return $this->hasMany(ReportEvidence::class, 'report_id')->orderByDesc('created_at');
    }

    public function latestEvidence(): HasOne
    {
        return $this->hasOne(ReportEvidence::class, 'report_id')->latestOfMany();
    }

    public function appNotifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'report_id');
    }

    /**
     * Generate kode laporan unik: LP-YYYYMMDD-XXXX
     */
    public static function generateKode(): string
    {
        $tanggal = now()->format('Ymd');
        $prefix  = "LP-{$tanggal}-";

        $last = self::where('kode_laporan', 'like', "{$prefix}%")
            ->orderByDesc('kode_laporan')
            ->value('kode_laporan');

        $urutan = $last ? ((int) substr($last, -4)) + 1 : 1;

        return $prefix . str_pad($urutan, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Cari laporan dengan kategori sama dalam radius (meter) menggunakan Haversine.
     * Mengembalikan laporan yang belum ditolak dan belum selesai.
     */
    public static function findNearby(float $lat, float $lng, int $categoryId, float $radiusMeters = 100): ?self
    {
        // Haversine formula langsung di SQL untuk SQLite
        return self::selectRaw("
                *,
                (6371000 * acos(
                    cos(radians(?)) * cos(radians(latitude))
                    * cos(radians(longitude) - radians(?))
                    + sin(radians(?)) * sin(radians(latitude))
                )) AS distance
            ", [$lat, $lng, $lat])
            ->where('category_id', $categoryId)
            ->whereNotIn('status', ['ditolak', 'selesai'])
            ->having('distance', '<=', $radiusMeters)
            ->orderBy('distance')
            ->first();
    }
}
