<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCinemaSchema extends Migration
{
    /**
    # Create a migration that creates all tables for the following user stories

    For an example on how a UI for an api using this might look like, please try to book a show at https://in.bookmyshow.com/.
    To not introduce additional complexity, please consider only one cinema.

    Please list the tables that you would create including keys, foreign keys and attributes that are required by the user stories.

    ## User Stories

     **Movie exploration**
     * As a user I want to see which films can be watched and at what times
     * As a user I want to only see the shows which are not booked out

     **Show administration**
     * As a cinema owner I want to run different films at different times
     * As a cinema owner I want to run multiple films at the same time in different locations

     **Pricing**
     * As a cinema owner I want to get paid differently per show
     * As a cinema owner I want to give different seat types a percentage premium, for example 50 % more for vip seat

     **Seating**
     * As a user I want to book a seat
     * As a user I want to book a vip seat/couple seat/super vip/whatever
     * As a user I want to see which seats are still available
     * As a user I want to know where I'm sitting on my ticket
     * As a cinema owner I dont want to configure the seating for every show
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('cinemas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('city_id');
            $table->string('row_name_prefix');
            $table->string('row_name_direction');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('seat_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('price_to_base_percantage');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cinema_id');
            $table->foreignId('seat_type_id');
            $table->integer('no_of_seats');
            $table->integer('no_of_rows');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('shows', function (Blueprint $table) {
            $table->id();
            $table->time('time');
            $table->foreignId('cinema_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('film_shows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('film_id');
            $table->foreignId('show_id');
            $table->double('base_price');
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->foreignId('film_show_id');
            $table->foreignId('seat_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
