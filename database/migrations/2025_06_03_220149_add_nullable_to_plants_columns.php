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
        Schema::table('plants', function (Blueprint $table) {
            $table->string('scientific_name')->nullable()->change();
            $table->string('common_name')->nullable()->change();
            $table->string('duration')->nullable()->change();
            $table->string('growth_habit')->nullable()->change();
            $table->string('subkingdom')->nullable()->change();
            $table->string('superdivision')->nullable()->change();
            $table->string('division')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plants', function (Blueprint $table) {
            //
        });
    }
};
