<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRankingResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranking_results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('rankable_id');
            $table->string('rankable_type');
            $table->bigInteger('system_id')->unsigned();
            $table->foreign('system_id')
                ->references('id')->on('ranking_systems')
                ->onDelete('cascade');
            $table->bigInteger('criteria_id')->unsigned();
            $table->foreign('criteria_id')
                ->references('id')->on('ranking_criteria')
                ->onDelete('cascade');
            $table->bigInteger('indicator_id')->unsigned()->nullable();
            $table->foreign('indicator_id')
                ->references('id')->on('ranking_indicators')
                ->onDelete('cascade');
            $table->integer('month');
            $table->integer('year');
            $table->integer('value')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('ranking_results');
    }
}
