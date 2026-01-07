<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Only add column if it doesn't already exist (helpful when DB state is out of sync)
        if (!Schema::hasColumn('users', 'username')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('username')->nullable()->unique()->after('name');
            });
        }

        // Populate username for existing users if missing
        $users = DB::table('users')->whereNull('username')->get();
        foreach ($users as $u) {
            $base = null;
            if (!empty($u->email) && strpos($u->email, '@') !== false) {
                $base = strstr($u->email, '@', true); // local part of email
            }
            if (empty($base)) {
                $base = 'user' . $u->id;
            }
            $candidate = $base;
            $i = 1;
            // Ensure uniqueness
            while (DB::table('users')->where('username', $candidate)->exists()) {
                $candidate = $base . $i;
                $i++;
            }
            DB::table('users')->where('id', $u->id)->update(['username' => $candidate]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
        });
    }
};
