<?php

use App\Models\Question;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('survey_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('name');

            // возможные типы checkbox / radio, в будущем могут появиться другие
            $table->tinyInteger('type')->default(Question::TYPE_CHECKBOX);

            $table->longText('text')->nullable();
            $table->json('pictures')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
