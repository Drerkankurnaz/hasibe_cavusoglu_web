<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('settings')
            ->where('group', 'site')
            ->where('name', 'footer_text')
            ->update([
                'payload' => json_encode('© ' . date('Y') . ' Design By Otimeta Tüm hakları saklıdır.'),
            ]);
    }

    public function down(): void
    {
        DB::table('settings')
            ->where('group', 'site')
            ->where('name', 'footer_text')
            ->update([
                'payload' => json_encode('© ' . date('Y') . ' Psikolog Hasibe Çavuşoğlu. Tüm hakları saklıdır. | OtiMeta2026'),
            ]);
    }
};
