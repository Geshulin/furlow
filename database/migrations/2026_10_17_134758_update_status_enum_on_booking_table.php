<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE booking MODIFY status ENUM('menunggu','diterima','ditolak','diproses','selesai','dibatalkan') NOT NULL DEFAULT 'menunggu'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE booking MODIFY status ENUM('menunggu','diterima','ditolak','diproses','selesai') NOT NULL DEFAULT 'menunggu'");
    }
};