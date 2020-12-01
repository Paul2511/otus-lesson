<?php

use App\Models\Adv;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('slug', 200)
                ->unique();
            $table->text('description')
                ->nullable();
            $table->string('place', 255)
                ->nullable();
            $table->string('picture', 200)
                ->nullable();
            $table->unsignedInteger('price')
                ->nullable();
            $table->unsignedSmallInteger('status')
                ->default(Adv::STATUS_INACTIVE);
            $table->unsignedInteger('type_adv');
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('price_type_id')
                ->nullable();
            $table->unsignedBigInteger('city_id')
                ->nullable();
            $table->unsignedInteger('section_id')
                ->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('price_type_id')
                ->references('id')
                ->on('price_types')
                ->onDelete('set null');
            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('set null');
            $table->foreign('section_id')
                ->references('id')
                ->on('sections')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advs');
    }
}
