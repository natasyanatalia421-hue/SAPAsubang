<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Officer extends Model
{
    protected $fillable = ['user_id', 'spesialisasi_kategori', 'status_aktif'];

    protected function casts(): array
    {
        return [
            'status_aktif'           => 'boolean',
            'spesialisasi_kategori'  => 'array', // JSON array category IDs
        ];
    }

    public function user(): BelongsTo { return $this->belongsTo(User::class, 'user_id'); }
}
