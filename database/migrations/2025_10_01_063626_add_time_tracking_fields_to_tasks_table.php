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
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedInteger('time_estimated')->nullable()->after('due_at')->comment('Estimated time in minutes');
            $table->unsignedInteger('time_taken')->nullable()->after('time_estimated')->comment('Actual time taken in minutes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn(['time_estimated', 'time_taken']);
        });
    }
};
