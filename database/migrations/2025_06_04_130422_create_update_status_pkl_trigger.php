<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::unprepared("
        CREATE TRIGGER update_status_pkl
        AFTER INSERT ON pkls
        FOR EACH ROW
        BEGIN
            UPDATE siswas
            SET status_pkl = 'Sedang PKL'
            WHERE id = NEW.siswa_id;
        END
    ");
    }

    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS update_status_pkl;");
    }
};
