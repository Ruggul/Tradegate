<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminLogsTable extends Migration
{
    public function up()
    {
        Schema::create('admin_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->string('action');
            $table->string('module');
            $table->text('description')->nullable();
            $table->string('ip_address');
            $table->text('user_agent')->nullable();
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin_logs');
    }
}
