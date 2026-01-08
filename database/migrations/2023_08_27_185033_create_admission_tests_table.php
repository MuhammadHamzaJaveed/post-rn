<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class   CreateAdmissionTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index()->constrained();
            $table->integer('selectedExam')->default(0);
            $table->string('md_cat_cnic', 200)->nullable();
            $table->string('md_cat_obtained_marks', 200)->nullable();
            $table->date('sat_test_date')->nullable();
            $table->integer('sat_biology_obtained_marks')->nullable();
            $table->integer('sat_chemistry_obtained_marks')->nullable();
            $table->integer('sat_phy_math_obtained_marks')->nullable();
            $table->string('sat_username', 200)->nullable();
            $table->string('sat_password', 200)->nullable();
            $table->string('ucat_band', 200)->nullable();
            $table->string('ucat_obtained_marks', 200)->nullable();
            $table->string('ucat_candidate_id', 200)->nullable();
            $table->date('ucat_test_date')->nullable();
            //mcat part
            $table->string('mcat_obtained_marks', 200)->nullable();
            $table->date('mcat_test_date')->nullable();
            $table->string('mcat_username', 200)->nullable();
            $table->string('mcat_password', 200)->nullable();
            $table->foreignId('md_catCenter_id')->nullable();
            $table->foreignId('mdcat_passing_year_id')->default(0);
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
        Schema::dropIfExists('admission_tests');
    }
}
