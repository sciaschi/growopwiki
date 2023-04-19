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
        Schema::create('plant_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('plant_id');
            $table->string('active_growth_period');
            $table->string('drought_tolerance');
            $table->string('fertility_requirement');
            $table->boolean('adapted_coarse_soil');
            $table->boolean('adapted_fine_soil');
            $table->boolean('adapted_medium_soil');
            $table->float('ph_min');
            $table->float('ph_max');
            $table->float('temp_min');
            $table->float('mature_height');
            $table->float('root_depth');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plant_details');
    }
};
