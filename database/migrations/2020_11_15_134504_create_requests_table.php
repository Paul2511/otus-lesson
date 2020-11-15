<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->string('type', 50);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->text('manager_comment');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->text('address')->nullable();
            $table->timestamp('date_time');
            $table->smallInteger('status')->default(10);
            $table->text('cancel_reason')->nullable();
            $table->text('user_comment')->nullable();
            $table->timestamps();

            $table->index('client_id');
            $table->index('user_id');
            $table->index('team_id');

            $table->foreign('client_id')
                ->references('id')->on('users')
                ->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('created_by')
                ->references('id')->on('users')
                ->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('team_id')
                ->references('id')->on('teams')
                ->onDelete('restrict')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
