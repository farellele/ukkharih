<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pkls', function (Blueprint $table) {
            // Hapus foreign key lama jika sudah ada
            $table->dropForeign(['siswa_id']);
            $table->dropForeign(['industri_id']);
            $table->dropForeign(['guru_id']);

            // Tambahkan kembali dengan ON DELETE RESTRICT
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('restrict');
            $table->foreign('industri_id')->references('id')->on('industris')->onDelete('restrict');
            $table->foreign('guru_id')->references('id')->on('gurus')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::table('pkls', function (Blueprint $table) {
            // Rollback ke ON DELETE CASCADE jika dibutuhkan
            $table->dropForeign(['siswa_id']);
            $table->dropForeign(['industri_id']);
            $table->dropForeign(['guru_id']);

            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
            $table->foreign('industri_id')->references('id')->on('industris')->onDelete('cascade');
            $table->foreign('guru_id')->references('id')->on('gurus')->onDelete('cascade');
        });
    }
};
