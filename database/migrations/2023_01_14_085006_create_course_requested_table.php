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
        Schema::create('course_requested', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('instit_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('title');
            $table->string('description', 255);
            $table->enum('category', ['IT', 'Sales', 'Marketing', 'Management', 'HR', 'Operations', 'Finance', 'Accounting', 'Public Relations', 'Research']);
            $table->date('receive_date');
            $table->string('accepted')->default('0'); // 0 no action 1 accepted 2 rejected
            $table->date('accepted_date')->nullable();
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
        Schema::dropIfExists('course_requested');
    }
};
