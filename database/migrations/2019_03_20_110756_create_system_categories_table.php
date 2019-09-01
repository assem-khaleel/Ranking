<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('system_id')->unsigned();
            $table->foreign('system_id')->references('id')->on('ranking_systems')->onDelete('cascade');
            $table->string('name_en', 512);
            $table->string('name_ar', 512);
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
        Schema::dropIfExists('system_categories');
    }
}
