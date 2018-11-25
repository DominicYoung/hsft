<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('games_id');
            $table->string('openid');
            $table->string('truename');
            $table->string('title');
            $table->string('order_id');
            $table->string('flow_id');
            $table->string('fee');
            $table->string('money');
            $table->string('note');
            $table->string('error');
            $table->string('worker');
            $table->string('worker_account');
            $table->tinyInteger('status')->default(0);
            $table->dateTime('finish_time')->nullable();
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
        Schema::drop('transfers');
    }
}
