<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adverts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('description');
            $table->string('price');
            $table->string('address');
            $table->integer('status')->default(\App\Models\Advert::STATUS_ACTIVE);
            $table->integer('is_premium')->default(\App\Models\Advert::PAYMENT_DEFAULT);
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');

            $table->foreign('region_id')
                ->references('id')
                ->on('regions')
                ->onDelete("cascade");
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete("cascade");
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete("cascade");

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
        Schema::dropIfExists('adverts');
    }
}
