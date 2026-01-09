<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index()->constrained();
            $table->string('ssc_science_subjects', 200)->nullable();
            $table->string('ssc_passing_year', 200)->nullable();
            $table->string('ssc_roll_no', 200)->nullable();
            $table->integer('ssc_marks_obtained')->nullable();
            $table->integer('ssc_total_marks')->nullable();
            $table->string('hssc_science_subjects', 200)->nullable();
            $table->string('hssc_passing_year', 200)->nullable();
            $table->string('hssc_roll_no', 200)->nullable();
            $table->integer('hssc_marks_obtained')->nullable();
            $table->integer('hssc_total_marks')->nullable();
            $table->foreignId('ssc_board_id')->nullable();
            $table->foreignId('ssc_exam_passeds_id')->nullable();
            $table->foreignId('hssc_exam_passeds_id')->nullable();
            $table->foreignId('hssc_board_id')->nullable();
            $table->foreignId('ssc_institution_id')->nullable();
            $table->foreignId('hssc_institution_id')->nullable();
            $table->integer('second_Db')->nullable();
            $table->string('physics', 200)->nullable();
            $table->string('biology', 200)->nullable();
            $table->string('chemistery', 200)->nullable();

            $table->string('nursing_passing_year', 200)->nullable();
            $table->string('nursing_roll_no', 200)->nullable();
            $table->integer('nursing_marks_obtained')->nullable();
            $table->integer('nursing_total_marks')->nullable();

            $table->string('current_job', 200)->nullable();
            $table->text('experiences')->nullable();
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
        Schema::dropIfExists('qualifications');
    }
}
