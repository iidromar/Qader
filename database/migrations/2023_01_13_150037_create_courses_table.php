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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('course_date');
            $table->enum('category', ['IT', 'Sales', 'Marketing', 'Management', 'HR', 'Operations', 'Finance', 'Accounting', 'Public Relations', 'Research']);
            $table->string('description', 255);
            $table->foreignId('creator')->references('id')->on('users')->cascadeOnDelete();
            $table->integer('price')->default('0');
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
        Schema::dropIfExists('courses');
    }
};
