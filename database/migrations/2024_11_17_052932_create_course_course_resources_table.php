<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseCourseResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_course_resources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->nullable()->constrained('courses')->onDelete('cascade');
            $table->foreignId('course_resource_id')->nullable()->constrained('course_resources')->onDelete('cascade');
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
        Schema::dropIfExists('course_course_resources');
    }
}
