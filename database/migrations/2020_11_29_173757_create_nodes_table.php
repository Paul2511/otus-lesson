<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nodes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('node_type_id')->constrained();
            $table->string('title', 100);
            $table->dateTime('deadline');
            $table->foreignId('status_id')->constrained();
            $table->unsignedSmallInteger('weight');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('parent_group_id')->constrained('groups');
            $table->timestamps();

            $table->index(['title', 'deadline', 'weight']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nodes');
    }
}
