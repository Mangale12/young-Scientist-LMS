<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('image_path')->nullable();
            $table->unsignedBigInteger('chalani_id')->nullable();
            $table->unsignedBigInteger('darta_id')->nullable();
            $table->softDeletes();
            $table->foreign('chalani_id')->references('id')->on('chalanis')->onDelete('cascade');
            $table->foreign('darta_id')->references('id')->on('dartas')->onDelete('cascade');
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
        Schema::dropIfExists('images');
    }
}
