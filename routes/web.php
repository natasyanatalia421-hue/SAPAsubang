<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\User\ReportController as UserReport;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\ReportController as AdminReport;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboard;
use App\Http\Controllers\Petugas\TaskController;
use Illuminate\Support\Facades\Route;

// ── Halaman Publik ────────────────────────────────────────────────────────────
Route::get('/',           [PublicController::class, 'home'])->name('home');
Route::get('/tentang',    [PublicController::class, 'tentang'])->name('tentang');
Route::get('/berita',     [PublicController::class, 'berita'])->name('berita');
Route::get('/berita/{slug}', [PublicController::class, 'beritaShow'])->name('berita.show');
Route::get('/laporan',    [PublicController::class, 'laporanPublik'])->name('laporan.publik');

// ── Autentikasi ────────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ── User (Pelapor) ─────────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard',               [UserDashboard::class, 'index'])->name('dashboard');

    Route::get('/laporan/buat',            [UserReport::class, 'create'])->name('reports.create');
    Route::post('/laporan',                [UserReport::class, 'store'])->name('reports.store');
    Route::get('/laporan/{report}',        [UserReport::class, 'show'])->name('reports.show');
    Route::get('/laporan/{report}/duplikat', [UserReport::class, 'duplicate'])->name('reports.duplicate');
    Route::post('/laporan/{report}/dukung', [UserReport::class, 'support'])->name('reports.support');
});

// ── Admin ──────────────────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard',                           [AdminDashboard::class, 'index'])->name('dashboard');

    Route::get('/laporan/{report}',                    [AdminReport::class, 'show'])->name('reports.show');
    Route::post('/laporan/{report}/verifikasi',        [AdminReport::class, 'verify'])->name('reports.verify');
    Route::post('/laporan/{report}/tolak',             [AdminReport::class, 'reject'])->name('reports.reject');
    Route::post('/laporan/{report}/tugaskan',          [AdminReport::class, 'assign'])->name('reports.assign');
    Route::post('/laporan/{report}/selesai',           [AdminReport::class, 'complete'])->name('reports.complete');
    Route::post('/laporan/{report}/revisi',            [AdminReport::class, 'requestRevision'])->name('reports.revision');

    Route::get('/kategori',                            [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/kategori',                           [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/kategori/{category}',                 [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/kategori/{category}',              [CategoryController::class, 'destroy'])->name('categories.destroy');
});

// ── Petugas ────────────────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard',                         [PetugasDashboard::class, 'index'])->name('dashboard');
    Route::get('/tugas/{report}',                    [TaskController::class, 'show'])->name('tasks.show');
    Route::post('/tugas/{report}/terima',            [TaskController::class, 'accept'])->name('tasks.accept');
    Route::post('/tugas/{report}/mulai',             [TaskController::class, 'startWork'])->name('tasks.start');
    Route::post('/tugas/{report}/bukti',             [TaskController::class, 'submitEvidence'])->name('tasks.evidence');
});

// ── Notifikasi (semua role yang login) ────────────────────────────────────────
Route::middleware('auth')->prefix('notifikasi')->name('notifications.')->group(function () {
    Route::get('/',                              [NotificationController::class, 'index'])->name('index');
    Route::get('/unread-count',                  [NotificationController::class, 'unreadCount'])->name('unread');
    Route::patch('/{notification}/baca',         [NotificationController::class, 'markRead'])->name('read');
});
