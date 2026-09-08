<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('kode_laporan', 30)->unique(); // LP-20260904-0001
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('restrict');
            $table->string('foto_sebelum'); // path file
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->text('deskripsi');
            $table->enum('status', [
                'menunggu_verifikasi',
                'ditolak',
                'terverifikasi',
                'ditugaskan',
                'menuju_lokasi',
                'sedang_ditangani',
                'menunggu_konfirmasi',
                'selesai',
            ])->default('menunggu_verifikasi');
            $table->enum('prioritas', ['rendah', 'sedang', 'tinggi', 'darurat'])->nullable();
            $table->foreignId('admin_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('petugas_id')->nullable()->constrained('users')->onDelete('set null');
            $table->text('alasan_ditolak')->nullable();
            $table->text('catatan_revisi')->nullable(); // catatan dari admin saat minta perbaikan
            $table->timestamps();

            // Index untuk query yang sering dilakukan
            $table->index('status');
            $table->index('category_id');
            $table->index('user_id');
            $table->index(['latitude', 'longitude']); // untuk cek duplikasi radius
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
