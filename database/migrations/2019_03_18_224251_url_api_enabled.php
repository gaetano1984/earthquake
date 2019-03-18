<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UrlApiEnabled extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('url_api_enabled', function(Blueprint $table){
            $table->increments('id');
            $table->string('url');
            $table->string('key', 255);
            $table->string('secret', 255);
            $table->tinyInteger('enabled')->default(0);
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
        Schema::drop('url_api_enabled');
    }
}
