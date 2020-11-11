<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenderAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tender_awards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('title')->nullable();
            $table->foreignId('tender_id')->constrained()->onDelete('cascade');
            $table->double('amount',11,2)->nullable();
            $table->string('currency')->nullable();
            $table->year('year');
            $table->string('external_id')->nullable();
            $table->string('status')->nullable();
            $table->string('status_details')->nullable();
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
        Schema::dropIfExists('tender_awards');
    }
}
