<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Bir kaydın daha önce kullandığı slug'ları tutar.
 * Slug değiştiğinde eski adresin 301 ile yenisine yönlendirilmesini sağlar.
 */
class SlugHistory extends Model
{
    public const UPDATED_AT = null;

    protected $fillable = [
        'sluggable_type',
        'sluggable_id',
        'slug',
    ];

    public function sluggable(): MorphTo
    {
        return $this->morphTo();
    }
}
