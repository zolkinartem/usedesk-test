<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateLogsTable
 */
class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('logs', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('api_user_id')->index();
            $table->string('action', 128);
            $table->jsonb('parameters');
            $table->timestamps();

            $table->foreign('api_user_id')
                ->references('id')
                ->on('api_users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
}
