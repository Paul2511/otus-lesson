<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParserTendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parser_tenders', function (Blueprint $table) {
            $table->id();
            $table->string('source_db')->nullable();
            $table->string('remove_id')->nullable();
            $table->string('entity_id')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('procedure_type')->nullable();
            $table->string('buyer_region')->nullable();
            $table->double('amount',11,2)->nullable();
            $table->string('currency')->nullable();
            $table->string('buyer_name')->nullable();
            $table->string('procedure_status')->nullable();
            $table->string('ownership_type')->nullable();
            $table->timestamp('modified_date')->nullable();
            $table->timestamp('last_date_update')->nullable();
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
        Schema::dropIfExists('parser_tenders');
    }
}
