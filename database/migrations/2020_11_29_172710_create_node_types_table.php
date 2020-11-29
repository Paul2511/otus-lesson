<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNodeTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('node_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20)->unique();
            $table->string('title', 20);
        });

        DB::insert("INSERT INTO
                        node_types (name, title)
                    VALUES
                        ('note', 'Note'),
                        ('simple-task', 'Simple Task'),
                        ('document', 'Document'),
                        ('task', 'Task')"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('node_types');
    }
}
