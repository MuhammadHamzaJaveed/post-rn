<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeritListDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merit_list_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index()->constrained();
            $table->foreignId('college_id');
            $table->foreignId('seat_categories_id');
            $table->foreignId('merit_list_id');
            $table->tinyInteger('admission_status')->length(1);
            $table->decimal('aggregate', 8, 4)->nullable();
            // $table->string('md_cat_cniord', 200)->nullable();
            // $table->foreignId('md_catCenter_id')->nullable();
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
        Schema::dropIfExists('merit_list_details');
    }
}
