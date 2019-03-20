<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UrlApiEnabledAddIpAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('url_api_enabled', function(Blueprint $table){
            $table->string('ip_address', 255)->nullable();
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
        Schema::table('url_api_enabled', function(Blueprint $table){
            $table->dropColumn('ip_address');
        });
    }
}
