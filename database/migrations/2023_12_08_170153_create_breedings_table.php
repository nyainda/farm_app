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
        Schema::create('breedings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('animal_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('type')->nullable();
            $table->date('heat_date')->nullable();
            $table->date('breeding_date')->nullable();
            $table->date('due_date')->nullable();
            $table->enum('pregnancy_status', ['not_pregnant', 'pregnant', 'unknown'])->nullable();
            $table->integer('offspring_count')->nullable();
            $table->text('offspring_ids')->nullable();
            $table->string('gender')->nullable();
            $table->string('health_status')->nullable();
            $table->integer('age')->nullable();
            $table->float('weight')->nullable();
            $table->string('color')->nullable();
            $table->integer('height')->nullable();
            $table->text('healthCondition')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('tankSize')->nullable();
            $table->text('habitat')->nullable();
            $table->text('species')->nullable();
            $table->text('feedingSchedule')->nullable();
            $table->text('breeding_history')->nullable();
            $table->text('genetic_details')->nullable();
            $table->text('breeding_recommendations')->nullable();
            $table->text('future_breeding_plans')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('animal_id')->references('id')->on('animals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('breedings');
    }
};
