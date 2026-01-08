<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
{
    Schema::create('colleges', function (Blueprint $table) {
        $table->id();
        $table->string('name', 100);
        $table->boolean('is_diploma')->default(false);
        $table->boolean('is_mcps')->default(false);
        $table->boolean('lahore')->default(false);
        $table->boolean('gujranwala')->default(false);
        $table->boolean('hafizabad')->default(false);
        $table->boolean('nankana_sahib')->default(false);
        $table->boolean('sheikhupura')->default(false);
        $table->boolean('multan')->default(false);
        $table->boolean('lodhran')->default(false);
        $table->boolean('muzaffargarh')->default(false);
        $table->boolean('okara')->default(false);
        $table->boolean('kasur')->default(false);
        $table->boolean('bahawalpur')->default(false);
        $table->boolean('rahim_yar_khan')->default(false);
        $table->boolean('sialkot')->default(false);
        $table->boolean('gujrat')->default(false);
        $table->boolean('mandi_bahauddin')->default(false);
        $table->boolean('narowal')->default(false);
        $table->boolean('dera_ghazi_khan')->default(false);
        $table->boolean('rajanpur')->default(false);
        $table->boolean('bhakkar')->default(false);
        $table->boolean('bahawalnagar')->default(false);
        $table->boolean('vehari')->default(false);
        $table->boolean('pakpattan')->default(false);
        $table->boolean('chakwal')->default(false);
        $table->boolean('sargodha')->default(false);
        $table->boolean('mianwali')->default(false);
        $table->boolean('sahiwal')->default(false);
        $table->boolean('khanewal')->default(false);
        $table->boolean('toba_tek_singh')->default(false);
        $table->boolean('attock')->default(false);
        $table->boolean('rawalpindi')->default(false);
        $table->boolean('jhelum')->default(false);
        $table->boolean('jhang')->default(false);
        $table->boolean('faisalabad')->default(false);
        $table->boolean('khushab')->default(false);
        $table->boolean('chiniot')->default(false);
        $table->boolean('layyah')->default(false);

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
        Schema::dropIfExists('colleges');
    }
}
