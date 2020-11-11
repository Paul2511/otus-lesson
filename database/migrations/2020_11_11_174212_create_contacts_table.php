<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('contact_type_id')->constrained()->onDelete('cascade');
            $table->text('comment');
            $table->enum('status',['raw','approved','declined'])->default('raw');
            $table->timestamps();
            $table->unique(['value','company_id','contact_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
