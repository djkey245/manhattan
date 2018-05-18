<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOtrsIdToReportsadmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reportsadms', function (Blueprint $table) {
            $table->integer('otrs_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reportsadms', function (Blueprint $table) {
            $table->dropColumn('otrs_id');
        });
    }
}
