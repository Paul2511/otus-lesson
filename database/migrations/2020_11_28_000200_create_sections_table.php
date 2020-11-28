<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)
                ->unique();
            $table->string('slug', 255)
                ->unique();
            $table->text('description')
                ->nullable();
            $table->unsignedInteger('group_id')
                ->nullable();
            $table->unsignedInteger('parent_id')
                ->nullable();
            $table->timestamps();
        });

        Schema::table('sections', function (Blueprint $table) {
            $table->foreign('group_id')
                ->references('id')
                ->on('section_groups')
                ->onDelete('cascade');
            $table->foreign('parent_id')
                ->references('id')
                ->on('sections');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections');
    }
}
