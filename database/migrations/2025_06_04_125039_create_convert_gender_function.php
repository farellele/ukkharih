<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::unprepared("
            CREATE FUNCTION convert_gender(gender CHAR(1)) RETURNS VARCHAR(15)
            DETERMINISTIC
            BEGIN
                DECLARE result VARCHAR(15);

                IF gender = 'L' THEN
                    SET result = 'Laki-laki';
                ELSEIF gender = 'P' THEN
                    SET result = 'Perempuan';
                ELSE
                    SET result = 'Tidak Diketahui';
                END IF;

                RETURN result;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP FUNCTION IF EXISTS convert_gender;");
    }
};
