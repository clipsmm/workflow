<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('stage_id');
            $table->foreign('stage_id')->references('id')->on('m_stages')->onDelete('cascade');
            $table->unsignedInteger('item_id');
            $table->string('item_type');
            $table->unsignedInteger('creator_id')->nullable();
            $table->string('creator_type')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('user_type')->nullable();
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->string('action')->nullable();
            $table->string('status')->default('pending');
            $table->longText('notes')->nullable();
            $table->dateTime('assigned_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->dateTime('expires_at')->nullable();
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
        Schema::dropIfExists('m_tasks');
    }
}
