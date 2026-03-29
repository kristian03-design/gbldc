<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingPageContent extends Model
{
    protected $fillable = [
        'target_audience',
        'section_type',
        'category',
        'title',
        'subtitle',
        'content',
        'image_path',
        'link_url',
        'icon_class',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];
}
