<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChampionshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('championships', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("title", 50);
            $table->string("modality", 15);
            $table->string("localization", 50);
            $table->boolean("mata_mata");
            $table->boolean("groups");
            $table->boolean("running_stitches");
            $table->boolean("return");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('championships');
    }
}
