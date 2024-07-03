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
        Schema::create('tasks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('animal_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('title');
            $table->date('start_date')->nullable();
            $table->integer('start_hour')->nullable();
            $table->integer('start_minute')->nullable();
            $table->integer('end_hour')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('end_minute')->nullable();
            $table->text('description')->nullable();
            $table->uuid('associated_to')->nullable();
            $table->string('color')->nullable();
            $table->string('status')->nullable();
            $table->string('priority')->nullable();
            $table->string('repeats')->nullable();
            $table->integer('repeat_frequency')->nullable();
            $table->date('end_repeat_date')->nullable();
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
        Schema::dropIfExists('tasks');
    }
};
