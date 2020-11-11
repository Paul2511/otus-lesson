<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_service', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('document_id');
            $table->string('1c_service_uuid')->unique();
            $table->foreign('document_id')
                    ->references('id')
                    ->on('documents')
                    ->onDelete("cascade");
            $table->foreign('1c_service_uuid')
                    ->references('1c_service_uuid')
                    ->on('services')
                    ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_service');
    }
}
