<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->references('id')->on('lessons')->cascadeOnDelete();
            $table->foreignId('employee_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('course_id')->references('id')->on('courses')->cascadeOnDelete();
            $table->string('state')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('check_progress');
    }
};
