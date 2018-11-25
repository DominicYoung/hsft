<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid');
            $table->integer('game_id');
            $table->string('headimg');
            $table->string('title');
            $table->string('truename');
            $table->string('phone');
            $table->tinyInteger('sex');
            $table->date('birthday');
            $table->string('danwei')->nullable();
            $table->string('zubie');
            $table->string('orderid');
            $table->string('flow_id');
            $table->string('money');
            $table->string('pay_status')->default(0); //1.支付成功 2.申请退款 3.退款成功 4.退款处理中
            $table->dateTime('pay_time')->nullable();
            $table->dateTime('refund_time')->nullable();
            $table->string('refund_money')->nullable();
            $table->string('refund_note')->nullable();
            $table->string('refund_worker')->nullable();

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
        Schema::drop('applies');
    }
}
