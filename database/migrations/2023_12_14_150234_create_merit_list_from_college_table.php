<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeritListFromCollegeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merit_list_from_colleges', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index()->constrained();
            $table->integer('selection_list_id')->default(0);
            $table->integer('college_from')->default(0);
            $table->integer('college_to');
            $table->integer('seat_id')->default(0);
            $table->text('student_affidavit_path')->nullable();
            $table->text('college_affidavit_path')->nullable();
            $table->integer('is_paid')->default(0);
            $table->integer('is_joined')->default(0);
            $table->integer('is_stay')->default(0);
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('merit_list_from_colleges');
    }
}
