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
        Schema::create('contacts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('animal_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('city')->nullable();
            $table->string('county')->nullable();
            $table->string('street_address')->nullable();
            $table->integer('postal_code')->nullable();
            $table->string('keywords')->nullable();
            $table->string('primary_phone')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->integer('fax')->nullable();
            $table->string('company')->nullable();
            $table->string('country')->nullable();
            $table->string('contact_type')->nullable();
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
        Schema::dropIfExists('contacts');
    }
};
