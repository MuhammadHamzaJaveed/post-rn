<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Otp\OtpTypes;
use App\Enums\Otp\OtpReasons;

class CreateOtpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('o_t_p_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index()->constrained();
            $table->bigInteger('otp_type_id')->default(OtpTypes::EMAIL);
            $table->bigInteger('otp_reason_id')->default(OtpReasons::EDITFORM);
            $table->string('value');
            $table->timestamp('used_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->softDeletes();
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
        Schema::dropIfExists('otps');
    }
}
