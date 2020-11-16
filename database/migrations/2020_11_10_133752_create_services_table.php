<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('specialist_uuid');
            $table->string('service_uuid')->unique();
            $table->boolean('sent_fms');
            $table->datetime('rnr_date');
            $table->string('inbox_num',20);
            $table->tinyInteger('rnr_status')
                ->default(\App\Models\ServiceStatus::STATUS_NEW);
            $table->datetime('rnr_ready');
            $table->datetime('rnr_recieved');
            $table->datetime('invite_sent');
            $table->tinyInteger('invite_status')
                ->default(\App\Models\ServiceStatus::STATUS_NEW);
            $table->datetime('invite_po');
            $table->datetime('invite_recieved');
            $table->datetime('visa_sent');
            $table->tinyInteger('visa_status')
                ->default(\App\Models\ServiceStatus::STATUS_NEW);
            $table->datetime('visa_po');
            $table->datetime('visa_recieved');
            $table->tinyInteger('specialist_status')
                ->default(\App\Models\ServiceStatus::STATUS_NEW);
            $table->timestamps();
            $table->foreign('specialist_uuid')
                    ->references('specialist_uuid')
                    ->on('specialists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
