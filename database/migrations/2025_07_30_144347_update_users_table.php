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
      Schema::table('users', function (Blueprint $table) {
        $table->string('regnumber', 50)->unique()->nullable()->after('name');
        $table->string('campus', 50)->nullable()->after('regnumber');
        $table->string('phone', 15)->nullable()->after('email');
        $table->enum('role', ['student','work','manager','admin'])->default('student')->after('password');
        $table->string('qr_code', 255)->nullable()->after('role');
        $table->string('passkey', 255)->default('')->after('qr_code');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
