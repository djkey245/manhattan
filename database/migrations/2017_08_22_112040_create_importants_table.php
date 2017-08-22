<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('importants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('actual');
            $table->string('str1');
            $table->string('str2');
            $table->integer('int1');
            $table->integer('int2');
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
        Schema::drop('importants');
    }
}
