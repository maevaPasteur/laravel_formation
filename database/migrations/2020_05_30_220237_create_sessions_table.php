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

<<<<<<< HEAD
            $table->foreign('formation_id')->references('id')->on('formations')->onDelete('cascade');
            $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
=======
            $table->foreign('formation_id')->references('id')->on('formations')->onDelete('cascade');;
            $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');;
>>>>>>> 893b6235f8b5c7ac8d4ab4c39e5f23e60d40bf5e
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
