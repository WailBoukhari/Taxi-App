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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scheduled_ride_id')->constrained()->onDelete('cascade');
            $table->foreignId('passenger_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('driver_id')->constrained('drivers')->onDelete('cascade'); // Change 'users' to 'drivers'
            $table->string('departure_city');
            $table->string('destination_city');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
