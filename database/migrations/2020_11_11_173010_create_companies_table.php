<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('identification_code');
            $table->string('title');
            $table->string('clear_title')->nullable();
            $table->string('raw_title')->nullable();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamp('registration_date')->nullable();
            $table->foreignId('legal_form_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('status')->default(10);
            $table->string('vat')->nullable();
            $table->timestamp('vat_register_date')->nullable();
            $table->timestamp('vat_cancel_date')->nullable();
            $table->string('excise')->nullable();
            $table->timestamp('excise_register_date')->nullable();
            $table->timestamp('excise_cancel_date')->nullable();
            $table->foreignId('country_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('companies');
    }
}
