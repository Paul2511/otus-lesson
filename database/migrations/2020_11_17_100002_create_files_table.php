<?php

use App\Models\File;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('fid')->default(Str::uuid());//уникальный хэш файла
            $table->string('url');
            $table->timestamps();
        });

        // аватарка по умолчанию
        $timestamp = Carbon::now();
        DB::table('files')->insert([
            'title' => config('files.default.title_avatar'),
            'fid' => config('files.default.fid_avatar'),
            'url' => config('files.default.url_avatar'),
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::drop('files');
    }
}
