<?php

use App\Models\Card;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Клубные карты
     *
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('count_month')->nullable();// если карта выдана на опр количество месяцев
            $table->integer('count_day')->nullable();//если карта выдана на опр количество дней
            $table->decimal('price', 8, 2);
            $table->integer('status')->default(Card::STATUS_ACTIVE);
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
        Schema::drop('cards');
    }
}
