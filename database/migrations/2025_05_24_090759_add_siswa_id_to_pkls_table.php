<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
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

            if (Schema::hasColumn('pkls', 'deleted_at')) {
                $table->dropSoftDeletes();
            }
        });
    }
};
