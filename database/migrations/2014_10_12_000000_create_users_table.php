<?php

use App\Enums\Status\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('college_id')->default(0);
            $table->foreignId('discipline_id')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('plain_password')->nullable();
            $table->string('father_name');
            $table->string('mobile_number')->nullable();
            $table->string('branch_code')->nullable();
            $table->string('branch_name')->nullable();
            $table->integer('challan_id')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('challan_amount')->nullable();
            $table->string('transaction_id')->nullable();
            $table->text('cnic_passport')->nullable();
            $table->bigInteger('cnic_passport_id')->nullable();
            $table->foreignId('program_id')->nullable();
            $table->integer('program_priority')->nullable();
            $table->foreignId('seat_id')->nullable();
            $table->integer('affirmation')->nullable();
            $table->boolean('accepted_terms_and_conditions')->default(false);
            $table->integer('status')->default(Status::REJECTED);
            $table->integer('edit_user_status')->default(0);
            $table->integer('verification_user_status')->default(0);
            $table->integer('selection_seat_id')->default(0);
            $table->decimal('aggregate', 8, 4)->nullable();
            $table->decimal('aggregate_overseas', 8, 4)->nullable();
            $table->text('comments')->nullable();
            $table->integer('foreigner')->nullable();
            $table->boolean('is_open_merit')->default(false);
            $table->timestamp('submitted_at')->nullable();
            $table->integer('is_completed')->default(0);
            $table->integer('is_completed_email')->default(0);
            $table->tinyInteger('is_paid')->default(0);
            $table->tinyInteger('admission_is_paid')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });

        DB::statement('ALTER TABLE users AUTO_INCREMENT = 800001');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};