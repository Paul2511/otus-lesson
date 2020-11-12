<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('external_hash'); // внешний идентификатор, для синхронизации с внешними источниками
            $table->string('name_view'); // имя для представления, для views
            $table->string('name_raw'); // имя исходника, как в файловой системе
            $table->string('path'); // путь от корня хранилища файлов приложения до исходника
            $table->string('extension'); // расширение
            $table->string('mime'); // MIME-тип, для определения бинарных данных
            $table->bigInteger('size')->unsigned(); // размер файла
            $table->timestamp('created_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
