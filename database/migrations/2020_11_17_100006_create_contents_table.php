<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Контент сайта и проч.
     *
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title')->nullable();
            $table->text('text')->nullable();//могут быть не заполненным либо тема, либо текст
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::drop('contents');
    }
}