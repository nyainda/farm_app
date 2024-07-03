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
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('animal_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('notification_type'); // 'reminder' or 'notification'
            $table->string('message');
            $table->string('status')->nullable();
            $table->boolean('feeding_reminder')->default(false);
            $table->time('reminder_time')->nullable();
            $table->boolean('feeding_notification')->default(false);
            $table->enum('notification_method', ['email', 'sms', 'push_notification'])->nullable();
            $table->dateTime('scheduled_at');
            $table->boolean('sent')->default(false);
            $table->string('type')->nullable();
            $table->json('data')->nullable();
            $table->string('notifiable_type'); // Add the notifiable_type column// Change data type to uuid
            $table->timestamp('read_at')->nullable(); // Add the read_at column
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
        Schema::dropIfExists('notifications');
    }
};
