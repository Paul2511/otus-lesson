<?php

use App\Models\Event;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('ip_address', 45)->nullable();
            $table->smallInteger('type')->index()->default(Event::TYPE_SYSTEM); // символьное представление объекта данных, например USER / POST / SMS
            $table->string('slug')->index()->default(Event::SLUG_DEFAULT); // символьное представление события, например UPDATE / DELETE / SEND
            $table->smallInteger('level')->unsigned()->default(Event::LEVEL_INFO); // уровень события (критичность проблемы)
            $table->string('data'); // полезные, в рамках события, данные
            $table->timestamp('created_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
