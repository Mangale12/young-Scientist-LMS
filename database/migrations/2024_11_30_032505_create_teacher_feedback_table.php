<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assignment_submission_id')->constrained()->onDelete('cascade')->nullable();
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade')->nullable();
            $table->longText('feedback')->nullable(); // Feedback from the teacher
            $table->boolean('is_viewed')->default(false);
            $table->integer('rating')->nullable();
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
        Schema::dropIfExists('teacher_feedback');
    }
}
