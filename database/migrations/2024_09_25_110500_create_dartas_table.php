<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDartasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dartas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fiscal_year_id')->nullable();
            $table->string('no')->nullable();
            $table->string('patra_chalani_no')->nullable();
            $table->string('subject')->nullable();
            $table->string('person_or_organization_name')->nullable();
            $table->string('date')->nullable();
            $table->string('branch')->nullable();
            $table->text('remarks')->nullable();
            $table->softDeletes();
            $table->foreign('fiscal_year_id')->references('id')->on('fiscal_years')->onDelete('cascade');
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
        Schema::dropIfExists('dartas');
    }
}
