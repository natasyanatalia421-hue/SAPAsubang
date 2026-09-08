<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportEvidence extends Model
{
    protected $fillable = ['report_id', 'foto_sesudah', 'keterangan_pekerjaan', 'petugas_id'];

    public function report(): BelongsTo  { return $this->belongsTo(Report::class, 'report_id'); }
    public function petugas(): BelongsTo { return $this->belongsTo(User::class, 'petugas_id'); }
}
