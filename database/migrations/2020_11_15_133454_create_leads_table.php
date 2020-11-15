<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('type', 50)->nullable();
            $table->smallInteger('status')->default(0);
            $table->string('internal_phone', 20)->nullable();
            $table->string('external_phone', 20)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->text('manager_comment')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->index('manager_id');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('manager_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('leads');
    }
}
