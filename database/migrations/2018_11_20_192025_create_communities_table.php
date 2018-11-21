<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('recordid');
            $table->string('community_board')->nullable();
            $table->string('district_ward')->nullable();
            $table->text('cccnewyork')->nullable();
            $table->text('data2go')->nullable();
            $table->text('community_profiles_planning')->nullable();
            $table->text('civicdashboards')->nullable();
            $table->string('nyc_boroughs')->nullable();
            $table->string('nyc_community_board')->nullable();
            $table->string('flag')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('communities');
    }
}
