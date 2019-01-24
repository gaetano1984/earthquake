<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Earthquake extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('earthquake', function(Blueprint $table){
            $table->increments('id');
            $table->char('id_earthquake');
            $table->timestamp('creationTime');
            $table->float('magnitude');
            $table->text('location');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('earthquake');
    }
}
