<?php

namespace App;

use App\Models\Setting;

class NullSetting extends Setting
{
    protected $attributes = [
        'site_title' => 'Site Title',
        'site_name' => 'Site Name',
        'sidebar_collapse' => false,

        'site_address' => 'Site Address',
        'site_mobile' => 'Site Contact Number',
        'site_email' => 'Site Email',
    ];
}
