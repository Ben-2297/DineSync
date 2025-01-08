<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    
    public $fillable = [
        'site_name',
        'site_title',
        'sidebar_collapse',
        'site_address',
        'site_mobile',
        'site_email',
    ];

    protected $casts = [
        'sidebar_collapse' => 'boolean',
    ];
}
