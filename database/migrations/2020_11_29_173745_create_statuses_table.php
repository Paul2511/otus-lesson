<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('node_type_id')->constrained();
            $table->string('name', 20);
            $table->string('title', 20);
            $table->timestamps();
        });

        DB::insert("INSERT INTO
                        statuses (node_type_id, name, title)
                    VALUES
                        (2, 'open', 'Open'),
                        (2, 'done', 'Done'),
                        (4, 'new', 'New'),
                        (4, 'open', 'Open'),
                        (4, 'in-progress', 'In Progress'),
                        (4, 'done', 'Done'),
                        (4, 'closed', 'Closed')"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statuses');
    }
}
