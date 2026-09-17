<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'no_hp',
        'google_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Helper role checks
    public function isAdmin(): bool    { return $this->role === 'admin'; }
    public function isPetugas(): bool  { return $this->role === 'petugas'; }
    public function isUser(): bool     { return $this->role === 'user'; }

    // Relasi
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class, 'user_id');
    }

    public function assignedReports(): HasMany
    {
        return $this->hasMany(Report::class, 'petugas_id');
    }

    public function supports(): HasMany
    {
        return $this->hasMany(ReportSupport::class, 'user_id');
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    public function officer(): HasOne
    {
        return $this->hasOne(Officer::class, 'user_id');
    }

    public function unreadNotificationsCount(): int
    {
        return $this->notifications()->where('sudah_dibaca', false)->count();
    }
}
