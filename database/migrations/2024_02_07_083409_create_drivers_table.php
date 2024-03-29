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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('profile_picture')->nullable();
            $table->text('description')->nullable();
            $table->string('license_number')->nullable();
            $table->string('license_plate')->nullable();
            $table->string('vehicle_brand')->nullable();
            $table->enum('status', ['inactive', 'active'])->default('inactive');
            $table->enum('availability', ['available', 'on_trip', 'offline' ])->default('offline');
            $table->enum('payment_method', ['cash', 'card', 'other'])->default('cash');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
