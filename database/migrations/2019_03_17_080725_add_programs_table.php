<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name_ar');
            $table->string('name_en');

            $table->bigInteger('responsible_id')->unsigned();

            $table->foreign('responsible_id')
                ->references('user_id')->on('institution_users')
                ->onDelete('cascade');

            $table->bigInteger('department_id')->unsigned();

            $table->foreign('department_id')
                ->references('id')->on('departments')
                ->onDelete('cascade');

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
        Schema::dropIfExists('programs');
    }
}
