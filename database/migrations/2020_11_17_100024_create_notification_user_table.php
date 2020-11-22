<?php

use App\Models\NotificationUser;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('notification_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('notification_id')->index('fk_notification_user_notification_id_idx');
            $table->unsignedBigInteger('user_id')->index('fk_notification_user_user_id_idx');
            $table->integer('status')->default(NotificationUser::STATUS_READY)->index('fk_notification_user_status_idx');//ожидает отправки
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::drop('notification_user');
    }
}
