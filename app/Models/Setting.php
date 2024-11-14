<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'site_name',
        'site_description',
        'logo',
        'favicon',
        'site_email',
        'site_contact',
        'site_phone',
        'site_mobile',
        'site_fax',
        'site_first_address',
        'site_second_address',
        'site_description',
        'map',
        'site_url',
        'social_profile_fb',
        'social_profile_twitter',
        'social_profile_instagram',
        'social_profile_linkedin',
       'member_notice_mail',

    ];
}
