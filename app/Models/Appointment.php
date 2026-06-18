<?php

namespace App\Models;

use App\Enums\AppointmentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'service_id',
        'preferred_at',
        'status',
        'notes',
        'kvkk_accepted',
    ];

    protected function casts(): array
    {
        return [
            'status' => AppointmentStatus::class,
            'preferred_at' => 'datetime',
            'kvkk_accepted' => 'boolean',
        ];
    }

    /**
     * Randevuya ait hizmet.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
