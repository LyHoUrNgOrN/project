<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventJoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event__joins', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('user_id');
            // $table->unsignedBigInteger('event_id');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreignId('event_id')->references('id')->on('events')->onDelete('CASCADE');
            $table->string("role");
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
        Schema::dropIfExists('event__joins');
    }
}
