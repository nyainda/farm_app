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
        Schema::create('contents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('animal_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->uuid('bill_of_sale_id')->unique();
            $table->text('descriptions')->nullable();
            $table->date('date');
            $table->string('keyword')->nullable();
            $table->string('sold_to')->nullable();
            $table->boolean('record_transaction')->default(true);
            $table->boolean('bill_of_sale')->default(true);
            $table->decimal('sale_price')->default(0.00);
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
        Schema::dropIfExists('contents');
    }
};
