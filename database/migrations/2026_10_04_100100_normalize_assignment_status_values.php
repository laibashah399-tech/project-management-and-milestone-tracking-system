<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Only Pending / Completed are allowed (PPT slide 6)
        DB::table('assignments')
            ->whereNotIn('status', ['Pending', 'Completed'])
            ->update(['status' => 'Pending']);
    }

    public function down(): void
    {
        // data fix only, nothing to undo
    }
};
