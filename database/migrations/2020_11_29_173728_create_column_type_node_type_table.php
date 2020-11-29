<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColumnTypeNodeTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('column_type_node_type', function (Blueprint $table) {
            $table->id();
            $table->foreignId('column_type_id')->constrained();
            $table->foreignId('node_type_id')->constrained();
            $table->timestamps();
        });

        DB::insert("INSERT INTO
                        column_type_node_type (column_type_id, node_type_id)
                    VALUES
                        (1, 1),
                        (1, 2),
                        (2, 2),
                        (3, 2),
                        (4, 3),
                        (4, 4),
                        (2, 4),
                        (3, 4)"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('column_type_node_type');
    }
}
