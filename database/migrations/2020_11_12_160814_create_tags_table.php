<?php

use App\Models\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug')->unique()->index();
            $table->integer('priority')->unsigned()->default(1000); // индекс сортировки, для ручного урпавления позицией тега в выводе
            $table->string('name');
            $table->smallInteger('status')->unsigned()->default(Tag::STATUS_ACTIVE); // состояние тега, активно / удалено
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
        Schema::dropIfExists('tags');
    }
}
