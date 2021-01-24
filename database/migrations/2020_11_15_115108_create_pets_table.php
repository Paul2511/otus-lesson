<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger( 'pet_type_id')->default(null);
            $table->unsignedBigInteger('client_id');
            $table->string('name');
            $table->smallInteger('age')->unsigned()->nullable();
            $table->string('bread')->nullable();
            $table->string('sex', 10)->nullable();
            $table->json('photo')->nullable();
            $table->timestamps();

            $table->index('pet_type_id');
            $table->index('client_id');

            $table->foreign('pet_type_id')
                ->references('id')->on('pet_types')
                ->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('client_id')
                ->references('id')->on('clients')
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

        Schema::dropIfExists('pets');
    }
}
