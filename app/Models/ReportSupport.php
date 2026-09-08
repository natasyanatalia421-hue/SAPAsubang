<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportSupport extends Model
{
    protected $fillable = ['report_id', 'user_id'];

    public function report(): BelongsTo { return $this->belongsTo(Report::class, 'report_id'); }
    public function user(): BelongsTo   { return $this->belongsTo(User::class, 'user_id'); }
}
