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
            $table->string('company_uuid')->unique();
            $table->string('name');
            $table->string('full_name');
            $table->unsignedBigInteger('inn')->unique();
            $table->unsignedBigInteger('kpp');
            $table->unsignedBigInteger('ogrn');
            $table->date('ogrn_date');
            $table->unsignedBigInteger('phone');
            $table->string('address_legal')->nullable();
            $table->string('address_actual')->nullable();
            $table->string('card_num',10);
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
