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
            $schema->text('latitude', 10)->nullable();
            $schema->text('longitude', 10)->nullable();
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
