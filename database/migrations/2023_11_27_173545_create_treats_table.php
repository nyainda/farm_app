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
        Schema::create('treats', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('animal_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('type'); // Treatment Type
            $table->string('product')->nullable(); // Details/Product
            $table->uuid('batch')->nullable();  // Batch #
            $table->decimal('amount')->nullable(); // Dosage/Amount
            $table->decimal('inventory_amount')->nullable(); // Inventory Amount Used
            $table->string('unit')->nullable(); // Unit
            $table->string('mode')->nullable(); // Application Method
            $table->string('site')->nullable(); // Treatment Location
            $table->unsignedInteger('days_to_withdrawal')->nullable(); // Days until Withdrawal Date
            $table->date('retreat_date')->nullable(); // Booster Date
            $table->string('technician')->nullable(); // Technician
            $table->string('currency')->nullable(); // Currency symbol (e.g., USD)
            $table->decimal('cost')->nullable(); // Treatment Total Cost
            $table->boolean('record_transaction')->default(false);
            $table->text('treatment_description')->nullable(); // Description
            $table->date('dates')->nullable(); // Treatment Date
            $table->string('treatment_keywords')->nullable(); // Keywords

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
        Schema::dropIfExists('treats');
    }
};
