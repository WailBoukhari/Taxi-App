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
            $table->foreignId('driver_id')->constrained()->onDelete('cascade');
            $table->string('departure_city_name'); 
            $table->string('destination_city_name');
            $table->string('seats_available')->nullable();
            $table->decimal('price', 8, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('scheduled_rides');
    }
}
