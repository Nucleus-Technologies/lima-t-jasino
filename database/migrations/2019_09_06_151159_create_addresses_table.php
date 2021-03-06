<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->enum('zone', ['national', 'international']);
            $table->string('country');
            $table->string('phone1');
            $table->string('phone2')->nullable();
            $table->string('addressline1');
            $table->string('addressline2')->nullable();
            $table->string('region');
            $table->string('city');
            $table->integer('zip')->nullable();
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
        Schema::dropIfExists('addresses');
    }
}
