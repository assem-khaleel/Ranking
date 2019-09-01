<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MaintainProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropForeign('programs_responsible_id_foreign');

            $table->foreign('responsible_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('programs', function (Blueprint $table) {

            $table->dropForeign('programs_responsible_id_foreign');

            $table->foreign('responsible_id')
                ->references('user_id')->on('institution_users')
                ->onDelete('cascade');
        });
    }
}
