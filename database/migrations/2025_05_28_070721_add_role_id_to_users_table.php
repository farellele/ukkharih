<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan contoh kolom baru
            $table->string('role')->nullable()->after('email');
            $table->timestamp('deleted_at')->nullable(); // Untuk Soft Deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus kolom yang ditambahkan jika rollback
            $table->dropColumn(['role', 'deleted_at']);
        });
    }
};
