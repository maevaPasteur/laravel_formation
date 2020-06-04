<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('start');
            $table->boolean('open');
            $table->unsignedBigInteger('formation_id');
            $table->unsignedBigInteger('classroom_id');
            $table->timestamps();

            $table->foreign('formation_id')->references('id')->on('formations')->onDelete('cascade');;
            $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}
