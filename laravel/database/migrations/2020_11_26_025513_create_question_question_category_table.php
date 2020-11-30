<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionQuestioncategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_question_category', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('question_id')
                ->constrained('questions')
                ->onDelete('cascade');
            $table
                ->foreignId('question_category_id')
                ->constrained('question_categories')
                ->onDelete('cascade');
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
        Schema::dropIfExists('question_question_category');
    }
}
