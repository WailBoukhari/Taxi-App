<?php

// 2024_02_06_152826_create_ratings_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->constrained()->onDelete('cascade');
            $table->foreignId('passenger_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('rating'); // Assuming rating is between 1 and 5
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('ratings');
    }
}
