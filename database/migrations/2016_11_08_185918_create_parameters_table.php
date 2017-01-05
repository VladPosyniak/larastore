<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('parameters', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('title');
//            $table->string('unit');
//            $table->timestamps();
//        });
//        Schema::create('parameters_values', function (Blueprint $table) {
//            $table->increments('id');
//            $table->integer('items_id');
//            $table->integer('parameters_id');
//            $table->string('value');
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('parameters');
        Schema::drop('parameters_values');
    }
}