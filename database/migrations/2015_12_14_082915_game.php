<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Game extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid');
            $table->string('nickname');
            $table->string('title');
            $table->dateTime('starttime');
            $table->dateTime('endtime');
            $table->string('address');
            $table->dateTime('deadline');
            $table->integer('people');
            $table->text('note');
            $table->tinyInteger('ispublish')->default(0);
            $table->string('truename');
            $table->decimal('fee',10,2);
            $table->string('phone');
            $table->string('groups');
            $table->string('qrcode');
            $table->tinyInteger('pause')->default(0);
            $table->tinyInteger('adminpause')->default(0);
            $table->tinyInteger('danwei')->default(0);
            $table->tinyInteger('finance')->default(0);   //是否转账

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
        Schema::drop('games');
    }
}
