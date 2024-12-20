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
        Schema::create('animals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            //$table->uuid('user_id');


            // Basic info
            $table->string('name');
            $table->string('type');
            $table->string('breed')->nullable();
            $table->string('gender')->nullable();
            $table->string('keywords')->nullable();
            $table->string('internal_id')->nullable();
            $table->string('status');
            $table->date('death_date')->nullable();
            $table->text('deceased_reason')->nullable();

            // Physical Characteristics
            $table->boolean('is_neutered')->nullable();
            $table->boolean('is_breeding_stock')->nullable();
            $table->string('coloring')->nullable();
            $table->decimal('retention_score', 5, 2)->nullable();
            $table->decimal('weight', 8, 2)->nullable();
            $table->decimal('height', 8, 2)->nullable();
            $table->decimal('body_condition_score', 3, 1)->nullable();
            $table->decimal('horn_length', 8, 2)->nullable();
            $table->string('tail_length_shape')->nullable();
            $table->string('fur_feather_scale_type')->nullable();
            $table->string('eye_color')->nullable();
            $table->string('beak_shape')->nullable();
            $table->string('tail_feather_pattern')->nullable();
            $table->string('saddle_markings')->nullable();
            $table->string('hoof_type')->nullable();
            $table->string('gait_or_movement')->nullable();
            $table->text('teeth_characteristics')->nullable();
            $table->text('description')->nullable();

            // Identification
            $table->string('tag_number')->nullable();
            $table->string('color')->nullable();
            $table->string('location')->nullable();
            $table->string('electronic_id')->nullable();
            $table->string('other_tag')->nullable();
            $table->string('other_color')->nullable();
            $table->string('other_location')->nullable();
            $table->string('registry_number')->nullable();
            $table->string('tattoo_left')->nullable();
            $table->string('tattoo_right')->nullable();
            $table->string('photographs')->nullable();
            $table->string('dna_profile')->nullable();
            $table->text('scars')->nullable();

            // Birth Information
            $table->date('birth_date')->nullable();
            $table->string('dam')->nullable();
            $table->string('sire')->nullable();
            $table->decimal('birth_weight')->nullable();
            $table->string('weight_unit')->nullable();
            $table->integer('age_to_wean')->nullable();
            $table->date('date_weaned')->nullable();
            $table->time('birth_time')->nullable();
            $table->string('birth_status')->nullable();
            $table->integer('colostrum_intake')->nullable();
            $table->string('health_at_birth');
            $table->text('milk_feeding')->nullable();
            $table->text('vaccinations')->nullable();
            $table->string('breeder_info')->nullable();
            $table->string('birth_photos')->nullable();
            $table->string('raised_purchased');

            // Sale
            $table->timestamps();
        });

       // Schema::create('animal_contents', function (Blueprint $table) {
        //    $table->uuid('id')->primary();
        //    $table->uuid('bill_of_sale_id')->unique();
        //    $table->text('descriptions')->nullable();
        //    $table->date('date');
        //    $table->string('keyword')->nullable();
        //    $table->string('sold_to')->nullable();
        //    $table->boolean('record_transaction')->default(true);
        //    $table->boolean('bill_of_sale')->default(true);
        //    $table->decimal('sale_price')->default(0.00);
        //    $table->timestamps();
        //});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
        //Schema::dropIfExists('animal_contents');


    }
};
