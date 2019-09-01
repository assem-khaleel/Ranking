<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRankingCriteriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranking_criteria', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('system_id')->unsigned();
            $table->foreign('system_id')->references('id')->on('ranking_systems')->onDelete('cascade');

            $table->string('name_en', 512);
            $table->string('name_ar', 512);

            $table->double('percentage', 8, 2);

            $table->text('description_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->boolean('enabled')->default(1);
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
        Schema::dropIfExists('ranking_criteria');
    }
}
