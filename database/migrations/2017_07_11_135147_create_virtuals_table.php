<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVirtualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('virtuals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_server');
            $table->string('name');
            $table->string('ip');
            $table->string('lp');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('virtuals');
    }
}
