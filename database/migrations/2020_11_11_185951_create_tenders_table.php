<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenders', function (Blueprint $table) {
            $table->id();
            $table->string('ocid');
            $table->string('title');
            $table->text('text')->nullable();
            $table->integer('value')->nullable();
            $table->string('currency')->nullable();
            $table->string('method')->nullable();
            $table->string('method_detail')->nullable();
            $table->timestamp('published_date')->nullable();
            $table->string('published_name')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->foreignId('cvp_code_id')->nullable()->constrained()->onDelete('set null');
            $table->text('cvp_description')->nullable();
            $table->string('url')->nullable();
            $table->foreignId('company_id')->nullable()->constrained()->onDelete('set null');
            $table->year('year');
            $table->string('status');
            $table->string('status_details');
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
        Schema::dropIfExists('tenders');
    }
}
