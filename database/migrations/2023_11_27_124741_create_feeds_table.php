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
        // Check if the users and animals tables exist before creating the feeds table
        if (Schema::hasTable('users') && Schema::hasTable('animals')) {
            Schema::create('feeds', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('animal_id');
                $table->unsignedBigInteger('user_id')->nullable();
                $table->decimal('amount', 8, 2)->nullable();
                $table->string('unit')->nullable();
                $table->string('feed_details')->nullable();
                $table->decimal('feed_weight', 8, 2)->nullable();
                $table->string('weight_unit')->nullable();
                $table->string('feeding_currency')->nullable();
                $table->decimal('estimated_cost', 8, 2)->nullable();
                $table->text('feeding_description')->nullable();
                $table->date('feeding_date')->nullable();
                $table->integer('repeat_days')->nullable();
                $table->string('feeding_method')->nullable();
                $table->string('food_type')->nullable();
                $table->string('feeder_name')->nullable();
                $table->time('feeding_time')->nullable();

                $table->timestamps();

                // Foreign key constraints
                $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
                $table->foreign('animal_id')->references('id')->on('animals')->onDelete('cascade');
            });
        } else {
            throw new Exception('Required tables (users or animals) do not exist.');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feeds');
    }
};
