<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardUserTable extends Migration
{
    /**
     * Клубные карты гостя
     *
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('card_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('fk_card_user_user_id_idx');
            $table->integer('card_id')->unsigned()->index('fk_card_user_card_id_idx');
            $table->date('start')->nullable();//подарочная карта выдается без даты начала использования
            $table->date('end')->nullable();//карта может быть досрочно аннулирована
            $table->string('status')->default('awaiting');//Ожидает подтверджения
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
        Schema::drop('card_user');
    }
}
