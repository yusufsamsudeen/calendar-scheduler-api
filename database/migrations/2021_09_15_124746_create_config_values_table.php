<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('config_id');
            $table->string('value');
            $table->string('code');
            $table->boolean('selected');
            $table->timestamps();

            $table->foreign('config_id')->references('id')->on('configs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config_values');
    }
}
