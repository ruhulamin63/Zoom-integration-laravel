<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zooms', function (Blueprint $table) {
            $table->id();
            $table->string('meeting_id');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('topic');
            $table->dateTime('start_time');
            $table->integer('duration')->comment('minutes');
            $table->string('password')->comment('meeting_password');
            $table->text('start_url');
            $table->text('join_url');
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
        Schema::dropIfExists('zooms');
    }
}
