<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('origin', ['user', 'admin']);
            $table->unsignedBigInteger('from');
            $table->unsignedBigInteger('to');
            $table->unsignedBigInteger('appointment');
            $table->foreign('appointment')->references('id')->on('appointments')->onDelete('cascade');
            $table->text('answered_message');
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
        Schema::dropIfExists('appointment_messages');
    }
}
