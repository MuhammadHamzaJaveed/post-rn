<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CollegeSeatsAvailableQuotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('college_seats_available_quotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merit_list_id');
            $table->foreignId('college_id');
            $table->integer('openMeritSeats')->default(0);
            $table->integer('overSeasSeats')->default(0);
            $table->integer('disabilitySeats')->default(0);
            $table->integer('cholistanSeats')->default(0);
            $table->tinyInteger('isReciprocal')->default(0);
            $table->integer('underDevelopArea')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('college_seats_available_quotas');
    }
}
