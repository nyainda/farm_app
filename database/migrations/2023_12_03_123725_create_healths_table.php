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
        Schema::create('healths', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('animal_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('vaccination_status')->nullable();
            $table->string('vet_contact_id')->nullable();
            $table->text('medical_history')->nullable();
            $table->string('dietary_restrictions')->nullable();
            $table->boolean('neutered_spayed')->nullable();
            $table->string('regular_medication')->nullable();
            $table->date('last_vet_visit')->nullable();
            $table->string('insurance_details')->nullable();
            $table->string('exercise_requirements')->nullable();
            $table->string('parasite_prevention')->nullable();
            $table->string('vaccine_name')->nullable();
            $table->date('date_administered')->nullable();
            $table->string('dosage')->nullable();
            $table->string('administered_by')->nullable();
            $table->string('dosage_unit')->nullable();
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
        Schema::dropIfExists('healths');
    }
};
