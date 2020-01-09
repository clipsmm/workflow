<?php

use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkflowActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_actions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('stage_id');
            $table->foreign('stage_id')->references('id')->on('m_stages')->onDelete('cascade');
            $table->unsignedBigInteger('next_stage_id')->nullable();
            $table->foreign('next_stage_id')->references('id')->on('m_stages')->onDelete('SET NULL');
            $table->string('name');
            $table->string('button');
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('m_actions');
    }
}
