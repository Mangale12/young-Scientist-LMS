<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable();
            $table->string('site_email')->nullable();
            $table->string('site_phone')->nullable();
            $table->string('site_mobile')->nullable();
            $table->string('site_fax')->nullable();
            $table->string('site_first_address')->nullable();
            $table->string('site_second_address')->nullable();
            $table->text('site_description')->nullable();
            $table->text('map')->nullable();
            $table->string('site_url')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('social_profile_fb')->nullable();
            $table->string('social_profile_twitter')->nullable();
            $table->string('social_profile_insta')->nullable();
            $table->string('social_profile_youtube')->nullable();
            $table->string('social_profile_linkedin')->nullable();
            $table->text('member_notice_mail')->nullable();
            $table->text('forgot_password_notice_mail_message')->nullable();
            $table->string('member_notice_mail_subject')->nullable();
            $table->string('forgot_password_notice_mail_subject')->nullable();
            $table->string('member_counters')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
