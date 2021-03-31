<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->string("name", 100)->required();
            $table->string("slug", 100)->required();
            $table->string("phone", 20)->required();
            $table->string("address")->required();
            $table->string("lat", 20)->nullable();
            $table->string("lon", 20)->nullable();
            $table->char("p_iva", 11)->required();
            $table->string("logo")->nullable(); //da rimettere 80
            $table->string('image_hero')->required();
            $table->timestamps();

            $table->foreign("user_id")
              ->references("id")
              ->on("users")
              ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
}
