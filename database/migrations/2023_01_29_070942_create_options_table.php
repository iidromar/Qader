<?php

use App\Models\Question;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('options')){
            Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->references('id')->on('questions')->cascadeOnDelete();
            $table->longText('option_text');
            $table->integer('points')->nullable();
            $table->timestamps();
        });
    }}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('options');
    }
}
