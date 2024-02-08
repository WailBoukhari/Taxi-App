<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduledRidesTable extends Migration
{
    public function up()
    {
        Schema::create('scheduled_rides', function (Blueprint $table) {
            $table->id();
            $table->string('driver_name')->nullable();
            $table->string('departure_city_name'); 
            $table->string('destination_city_name');
            $table->string('vehicle_type')->nullable();
            $table->string('seats_available')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('scheduled_rides');
    }
}
