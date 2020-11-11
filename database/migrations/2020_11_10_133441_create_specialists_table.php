<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialists', function (Blueprint $table) {
            $table->id();
            $table->string('1c_company_uuid')->unique();
            $table->string('1c_specialist_uuid')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->datetime('dob');
            $table->string('position')->nullable();
            $table->timestamps();
            $table->foreign('1c_company_uuid')
                    ->references('1c_company_uuid')
                    ->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specialists');
    }
}
