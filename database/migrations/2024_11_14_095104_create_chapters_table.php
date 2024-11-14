<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('unique_id')->nullable();
            $table->foreignId('chapter_category_id')->constrained('chapter_categories')->onDelete('cascade');
            $table->longText('description')->nullable();
            $table->boolean('is_complete')->default(false);
            $table->foreignId('course_id')->nullable()->constrained('courses')->onDelete('cascade');
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
        Schema::dropIfExists('chapters');
    }
}
