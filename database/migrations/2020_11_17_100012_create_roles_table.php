<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    //TODO: после создания модели заменить значения из соответствующих констант модели
    private const ROLES = [
        'admin',
        'guest',
        'trainer',
        'support',
        'anonymous',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('role');
            $table->timestamps();
        });

        $timestamp = Carbon::now();
        foreach (self::ROLES as $role) {
            DB::table('roles')->insert([
                'role' => $role,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::drop('roles');
    }
}
