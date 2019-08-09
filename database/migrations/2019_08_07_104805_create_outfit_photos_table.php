<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutfitPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outfit_photos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('outfit');
            $table->foreign('outfit')->references('id')->on('outfits')->onDelete('cascade');
            $table->string('filename')->unique();
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
        Schema::dropIfExists('outfit_photos');
    }
}
