<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    protected $fillable = ['user_id', 'report_id', 'judul', 'pesan', 'sudah_dibaca'];

    protected function casts(): array
    {
        return ['sudah_dibaca' => 'boolean'];
    }

    public function user(): BelongsTo   { return $this->belongsTo(User::class, 'user_id'); }
    public function report(): BelongsTo { return $this->belongsTo(Report::class, 'report_id'); }

    /**
     * Kirim notifikasi ke satu user
     */
    public static function kirim(int $userId, string $judul, string $pesan, ?int $reportId = null): self
    {
        return self::create([
            'user_id'   => $userId,
            'report_id' => $reportId,
            'judul'     => $judul,
            'pesan'     => $pesan,
            'sudah_dibaca' => false,
        ]);
    }
}
