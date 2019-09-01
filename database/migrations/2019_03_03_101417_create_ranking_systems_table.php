<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRankingSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranking_systems', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name_en', 512);
            $table->string('name_ar', 512);

            $table->string('url');

            $table->text('description_en')->nullable();
            $table->text('description_ar')->nullable();

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
        Schema::dropIfExists('ranking_systems');
    }
}
