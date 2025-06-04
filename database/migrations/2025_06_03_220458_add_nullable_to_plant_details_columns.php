<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plant_details', function (Blueprint $table) {
            $table->string('active_growth_period')->nullable()->change();
            $table->string('drought_tolerance')->nullable()->change();
            $table->string('fertility_requirement')->nullable()->change();
            $table->boolean('adapted_coarse_soil')->nullable()->change();
            $table->boolean('adapted_fine_soil')->nullable()->change();
            $table->boolean('adapted_medium_soil')->nullable()->change();
            $table->float('ph_min')->nullable()->change();
            $table->float('ph_max')->nullable()->change();
            $table->float('temp_min')->nullable()->change();
            $table->float('mature_height')->nullable()->change();
            $table->float('root_depth')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plant_details_columns', function (Blueprint $table) {
            //
        });
    }
};
