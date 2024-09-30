<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDartaChalanisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('darta_chalanis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fiscal_year_id')->nullable();
            $table->string('darta_no')->nullable();
            $table->string('chalani_no')->nullable();
            $table->string('patra_chalani_no')->nullable();
            $table->string('subject')->nullable();
            $table->string('name')->nullable();
            $table->string('date')->nullable();
            $table->string('added_date')->nullable();
            $table->boolean('is_approved');
            $table->text('approved_user_id')->nullable();
            $table->dateTime('approved_date')->nullable();
            $table->dateTime('darta_date_eng')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('office_id')->nullable();
            $table->text('remarks')->nullable();
            $table->boolean('is_darta')->nullable()->default(false);
            $table->softDeletes();
            $table->foreign('fiscal_year_id')->references('id')->on('fiscal_years')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('office_id')->references('id')->on('offices')->onDelete('cascade');
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
        Schema::dropIfExists('darta_chalanis');
    }
}
