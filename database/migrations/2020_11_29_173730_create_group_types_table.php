<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20)->unique();
            $table->string('title', 20);
            $table->timestamps();
        });

        DB::insert("INSERT INTO
                        group_types (name, title)
                    VALUES
                        ('space', 'Space'),
                        ('folder', 'Folder'),
                        ('simple-list', 'Simple List'),
                        ('task-list', 'Task List')"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_types');
    }
}
