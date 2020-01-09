<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkflowStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_stages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('workflow_id');
            $table->foreign('workflow_id')->references('id')->on('m_workflows')->onDelete('cascade');
            $table->string('name');
            $table->string('type');
            $table->integer('max_duration')->nullable();
            $table->integer('order_no')->nullable();
            $table->boolean('entity_editable')->default(false);
            $table->unsignedBigInteger('expired_stage_id')->nullable();
            $table->boolean('notify')->default(false);
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('expired_stage_id')->references('id')->on('m_stages')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_stages');
    }
}
