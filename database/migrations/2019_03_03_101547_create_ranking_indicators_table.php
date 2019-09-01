<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRankingIndicatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranking_indicators', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('criterion_id')->unsigned();
            $table->foreign('criterion_id')->references('id')->on('ranking_criteria')->onDelete('cascade');

            $table->string('name_en', 512);
            $table->string('name_ar', 512);

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
        Schema::dropIfExists('ranking_indicators');
    }
}
