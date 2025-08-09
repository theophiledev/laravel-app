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
Schema::create('food_taken', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('student_id')->nullable();
    $table->timestamp('date')->nullable()->useCurrent();
    $table->integer('payment_amount')->default(0);
    $table->integer('meal_cost')->default(0);
    $table->integer('times_remaining')->default(0);
    $table->integer('times_taken')->default(0);
    $table->foreign('student_id')->references('id')->on('users');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_takens');
    }
};
