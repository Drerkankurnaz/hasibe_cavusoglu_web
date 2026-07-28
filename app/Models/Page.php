<?php

namespace App\Models;

use App\Models\Concerns\RecordsSlugHistory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Page extends Model
{
    use HasSlug;
    use RecordsSlugHistory;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'seo_title',
        'seo_description',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}
