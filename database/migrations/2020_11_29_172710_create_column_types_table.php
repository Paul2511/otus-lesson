<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColumnTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('column_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20)->unique();
            $table->string('title', 20);
            $table->timestamps();
        });

        DB::insert("INSERT INTO
                        column_types (name, title)
                    VALUES
                        ('detail', 'Detail'),
                        ('deadline', 'Deadline'),
                        ('status', 'Status'),
                        ('description', 'Description')"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('column_types');
    }
}
