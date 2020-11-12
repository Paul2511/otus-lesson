<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advert_images', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail');
            $table->unsignedBigInteger('advert_id');
            $table->foreign('advert_id')
                ->references('id')
                ->on('adverts')
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
        Schema::dropIfExists('advert_images');
    }
}
