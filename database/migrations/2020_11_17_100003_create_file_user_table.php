<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileUserTable extends Migration
{
    /**
     * Связь пользователей с файлами (например с личными/дефолтными аватарками)
     *
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('file_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('fk_file_user_user_id_idx');
            $table->unsignedBigInteger('file_id')->index('fk_file_user_file_id_idx');
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
        Schema::drop('file_user');
    }
}