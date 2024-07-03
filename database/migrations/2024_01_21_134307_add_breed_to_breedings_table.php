<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('breedings', function (Blueprint $table) {
            $table->date('egg_laying_start_date')->nullable();
            $table->date('egg_laying_end_date')->nullable();
            $table->string('temp')->nullable();
            $table->date('hatching_date')->nullable();
            $table->string('no_eggs')->nullable();
            $table->string('period_day')->nullable();
            $table->string('humidity')->nullable();
            $table->string('nesting_material')->nullable();
            $table->string('light_condition')->nullable();
            $table->string('environmental_conditions')->nullable();
            $table->string('number_of_chicks')->nullable();
            $table->string('egg_stage')->nullable();
            $table->string('pupal_stage')->nullable();
            $table->string('adult_stage')->nullable();
            $table->string('water_ph')->nullable();
            $table->string('tank_size')->nullable();
            $table->string('spawning_behavior')->nullable();
            $table->string('fry_tank_setup')->nullable();
            $table->string('fry_feeding')->nullable();
            $table->string('spawning_substrate')->nullable();
            $table->string('water_quality_monitoring')->nullable();
            $table->string('date_of_breeding')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('breedings', function (Blueprint $table) {
            $table->dropColumn('egg_laying_start_date');
            $table->dropColumn('egg_laying_end_date');
            $table->dropColumn('temp');
            $table->dropColumn('hatching_date');
            $table->dropColumn('no_eggs');
            $table->dropColumn('period_day');
            $table->dropColumn('humidity');
            $table->dropColumn('nesting_material');
            $table->dropColumn('light_condition');
            $table->dropColumn('environmental_conditions');
            $table->dropColumn('number_of_chicks');
            $table->dropColumn('egg_stage');
            $table->dropColumn('pupal_stage');
            $table->dropColumn('adult_stage');
            $table->dropColumn('water_ph');
            $table->dropColumn('tank_size');
            $table->dropColumn('spawning_behavior');
            $table->dropColumn('fry_tank_setup');
            $table->dropColumn('fry_feeding');
            $table->dropColumn('spawning_substrate');
            $table->dropColumn('water_quality_monitoring');
            $table->dropColumn('date_of_breeding');
        });
    }
};
