<?php

namespace App\Models\Concerns;

use App\Models\SlugHistory;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Slug değiştiğinde eskisini otomatik olarak geçmişe yazar.
 *
 * Böylece panelden bir başlık/slug güncellendiğinde eski adres kırılmaz;
 * controller eski slug'ı geçmişte bulup 301 ile yenisine yönlendirir.
 */
trait RecordsSlugHistory
{
    protected static function bootRecordsSlugHistory(): void
    {
        static::updating(function (self $model): void {
            if (! $model->isDirty('slug')) {
                return;
            }

            $previous = $model->getOriginal('slug');

            if (blank($previous) || $previous === $model->slug) {
                return;
            }

            // Yeni slug baska bir kaydin gecmisinde duruyorsa once serbest birak,
            // aksi halde unique kisiti nedeniyle kayit basarisiz olur.
            SlugHistory::where('slug', $model->slug)->delete();

            SlugHistory::updateOrCreate(
                ['slug' => $previous],
                [
                    'sluggable_type' => static::class,
                    'sluggable_id' => $model->getKey(),
                ],
            );
        });

        // Kayit silinince gecmisi de gitsin; slug yeniden kullanilabilir kalsin.
        static::deleted(function (self $model): void {
            $model->slugHistories()->delete();
        });
    }

    public function slugHistories(): MorphMany
    {
        return $this->morphMany(SlugHistory::class, 'sluggable');
    }

    /**
     * Verilen slug bu modelin gecmisinde varsa guncel kaydi dondurur.
     */
    public static function findByHistoricalSlug(string $slug): ?static
    {
        $history = SlugHistory::query()
            ->where('sluggable_type', static::class)
            ->where('slug', $slug)
            ->first();

        $model = $history?->sluggable;

        return $model instanceof static ? $model : null;
    }
}
