<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title_en',
        'title_ar',
        'description_en',
        'description_ar',
        'details_en',
        'details_ar',
        'icon',
        'background_image',
        'is_active',
        'sort_order',
        // SEO fields
        'meta_title_en',
        'meta_title_ar',
        'meta_description_en',
        'meta_description_ar',
        'meta_keywords_en',
        'meta_keywords_ar',
        'slug_en',
        'slug_ar',
    ];

    protected $casts = [
        'meta_keywords_en' => 'array',
        'meta_keywords_ar' => 'array',
        'is_active' => 'boolean',
    ];
}
