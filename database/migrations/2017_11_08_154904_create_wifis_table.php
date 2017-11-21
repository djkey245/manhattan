<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWifisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wifi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->string('cap');
            $table->time('time_at');
            $table->date('date_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('wifi');
    }
}
