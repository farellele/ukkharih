<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::table('pkls', function (Blueprint $table) {
            if (!Schema::hasColumn('pkls', 'siswa_id')) {
                $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            }

            if (!Schema::hasColumn('pkls', 'industri_id')) {
                $table->foreignId('industri_id')->constrained('industris')->onDelete('cascade');
            }

            if (!Schema::hasColumn('pkls', 'guru_id')) {
                $table->foreignId('guru_id')->constrained('gurus')->onDelete('cascade');
            }

            if (!Schema::hasColumn('pkls', 'waktu_mulai')) {
                $table->datetime('waktu_mulai')->nullable();
            }

            if (!Schema::hasColumn('pkls', 'waktu_selesai')) {
                $table->datetime('waktu_selesai')->nullable();
            }

            if (!Schema::hasColumn('pkls', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pkls', function (Blueprint $table) {
            if (Schema::hasColumn('pkls', 'siswa_id')) {
                $table->dropForeign(['siswa_id']);
                $table->dropColumn('siswa_id');
            }

            if (Schema::hasColumn('pkls', 'industri_id')) {
                $table->dropForeign(['industri_id']);
                $table->dropColumn('industri_id');
            }

            if (Schema::hasColumn('pkls', 'guru_id')) {
                $table->dropForeign(['guru_id']);
                $table->dropColumn('guru_id');
            }

            if (Schema::hasColumn('pkls', 'waktu_mulai')) {
                $table->dropColumn('waktu_mulai');
            }

            if (Schema::hasColumn('pkls', 'waktu_selesai')) {
                $table->dropColumn('waktu_selesai');
            }

            if (Schema::hasColumn('pkls', 'deleted_at')) {
                $table->dropSoftDeletes();
            }
        });
    }
};
