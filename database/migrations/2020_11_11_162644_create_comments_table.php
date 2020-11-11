<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text("text");
            $table->bigInteger("user_id")->unsigned();
            $table->index("user_id");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->bigInteger("task_id")->unsigned();
            $table->index("task_id");
            $table->foreign("task_id")->references("id")->on("tasks")->onDelete("cascade");
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
        Schema::dropIfExists('comments');
    }
}
