<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenderAwardItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tender_award_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tender_award_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('cvp_code_id')->nullable()->constrained()->onDelete('set null');
            $table->text('cvp_description')->nullable();
            $table->text('description')->nullable();
            $table->decimal('quantitty', 11, 2)->nullable();
            $table->string('unit')->nullable();
            $table->decimal('value', 11, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()    {

        Schema::dropIfExists('tender_award_items');
    }
}
