<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpdHisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upd_his', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uid');
            $table->string('target');
            $table->integer('logickey');
            $table->string('before');
            $table->string('after');
            $table->string('ext');
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
        Schema::dropIfExists('upd_his');
    }
}
