<?php

use App\Models\SectionGroup;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)
                ->unique();
            $table->string('slug', 255)
                ->unique();
            $table->text('description');
            $table->smallInteger('status')
                ->default(SectionGroup::STATUS_INACTIVE);
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
        Schema::dropIfExists('section_groups');
    }
}
