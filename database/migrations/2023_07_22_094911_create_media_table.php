<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('mediaable_type');
            $table->unsignedBigInteger('mediaable_id');
            $table->string('name');
            $table->string('path');
            $table->string('disk');
            $table->string('size');
            $table->string('collection')->nullable();

            $table->index(['mediaable_type', 'mediaable_id'], 'mediaable_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media');
    }
}
