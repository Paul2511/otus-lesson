<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_user', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_from_id')->unsigned();
            $table->bigInteger('user_to_id')->unsigned();
            $table->bigInteger('message_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('message_user', function(
            Blueprint $table
        ){
            $table->foreign('user_from_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('user_to_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('message_id')
                ->references('id')
                ->on('messages')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message_link');
    }
}
