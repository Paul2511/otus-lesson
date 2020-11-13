<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration
{

    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->foreign('column_id')->references('id')->on('columns')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('task_id')->references('id')->on('tasks')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });

        Schema::table('task_images', function (Blueprint $table) {
            $table->foreign('task_id')->references('id')->on('tasks')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('comment_images', function (Blueprint $table) {
            $table->foreign('comment_id')->references('id')->on('comments')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign('tasks_column_id_foreign');
            $table->dropForeign('tasks_user_id_foreign');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign('comments_task_id_foreign');
            $table->dropForeign('comments_user_id_foreign');
        });

        Schema::table('task_images', function (Blueprint $table) {
            $table->dropForeign('task_images_task_id_foreign');
        });
        Schema::table('comment_images', function (Blueprint $table) {
            $table->dropForeign('comment_images_comment_id_foreign');
        });
    }
}
