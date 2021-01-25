<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSkillUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skill_user', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')
                  ->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('skill_id')->unsigned()->index();
            $table->foreign('skill_id')->references('id')
                  ->on('skills')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('level_id')->unsigned()->index();
            $table->foreign('level_id')->references('id')
                  ->on('levels')->onDelete('cascade')->onUpdate('cascade');

            $table->unique(['user_id', 'skill_id']);

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skill_user');
    }
}
