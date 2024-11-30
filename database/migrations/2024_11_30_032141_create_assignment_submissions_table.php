<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assignment_id')->constrained()->onDelete('cascade')->nullable();
            $table->foreignId('student_id')->constrained()->onDelete('cascade')->nullable();
            $table->string('file_path')->nullable(); // Path to submitted file
            $table->longText('description')->nullable();
            $table->boolean('is_viewed')->default(false);
            $table->boolean('is_replied')->default(false);
            $table->text('notes')->nullable(); // Additional notes by the student
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
        Schema::dropIfExists('assignment_submissions');
    }
}
