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
            $table->string('1c_specialist_uuid')->unique();
            $table->string('1c_service_uuid')->unique();
            $table->boolean('sent_fms');
            $table->datetime('rnr_date');
            $table->string('inbox_num');
            $table->enum('rnr_status', ['new', 'draft', 'to_sign', 'passed', 'recieved', 'closed', 'canceled', 'refused', 'refund', 'client', 'from']);
            $table->datetime('rnr_ready');
            $table->datetime('rnr_recieved');
            $table->datetime('invite_sent');
            $table->enum('invite_status', ['new', 'draft', 'to_sign', 'passed', 'recieved', 'closed', 'canceled', 'refused', 'refund', 'client', 'from']);
            $table->datetime('invite_po');
            $table->datetime('invite_recieved');
            $table->datetime('visa_sent');
            $table->enum('visa_status', ['new', 'draft', 'to_sign', 'passed', 'recieved', 'closed', 'canceled', 'refused', 'refund', 'client', 'from']);
            $table->datetime('visa_po');
            $table->datetime('visa_recieved');
            $table->enum('specialist_status', ['new', 'draft', 'to_sign', 'passed', 'recieved', 'closed', 'canceled', 'refused', 'refund', 'client', 'from']);
            $table->timestamps();
            $table->foreign('1c_specialist_uuid')
                    ->references('1c_specialist_uuid')
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
