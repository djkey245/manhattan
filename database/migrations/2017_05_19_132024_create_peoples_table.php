<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeoplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peoples', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('surname');
            $table->date('birthday');
            $table->string('profession');
            $table->string('skype');
            $table->string('slug');
            $table->string('mail');
            $table->string('mail_work');
            $table->string('phone');
            $table->string('server');
            $table->string('server_vnc');
            $table->string('server_rdp');
            $table->string('virtual1');
            $table->string('virtual2');
            $table->integer('actual');
            $table->boolean('action');
            $table->string('login_otrs');
            $table->string('character');
            $table->longText('comments');
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
        Schema::drop('peoples');
    }
}
