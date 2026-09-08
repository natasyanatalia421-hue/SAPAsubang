<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportStatusLog extends Model
{
    protected $fillable = ['report_id', 'status_lama', 'status_baru', 'diubah_oleh', 'catatan'];

    public function report(): BelongsTo    { return $this->belongsTo(Report::class, 'report_id'); }
    public function changedBy(): BelongsTo { return $this->belongsTo(User::class, 'diubah_oleh'); }

    public function getStatusLamaLabelAttribute(): string
    {
        return Report::$statusLabels[$this->status_lama] ?? $this->status_lama ?? '-';
    }

    public function getStatusBaruLabelAttribute(): string
    {
        return Report::$statusLabels[$this->status_baru] ?? $this->status_baru;
    }
}
