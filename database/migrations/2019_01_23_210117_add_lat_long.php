<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLatLong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('earthquake', function(Blueprint $schema){
            $schema->char('latitude', 255)->nullable();
            $schema->char('longitude', 255)->nullable();
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
        Schema::table('earthquake', function(Blueprint $table){
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
        });
    }
}
