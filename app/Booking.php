<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Accommodation booking (Umrah/Ziyarat stays).
 * Table: bookings. Supports guest (user_id null) and logged-in user bookings.
 */
class Booking extends Model
{
    protected $table = 'bookings';

    protected $fillable = [
        'user_id',
        'accommodation_id',
        'check_in_date',
        'check_out_date',
        'nights',
        'adults',
        'kids',
        'price_per_night',
        'chauffeur_service_id',
        'chauffeur_price',
        'arrival_airport',
        'flight_number',
        'total_price',
        'status',
        'reference',
    ];

    protected $casts = [
        'check_in_date'  => 'date',
        'check_out_date' => 'date',
        'nights'         => 'integer',
        'adults'         => 'integer',
        'kids'           => 'integer',
        'price_per_night' => 'decimal:2',
        'chauffeur_price' => 'decimal:2',
        'total_price'    => 'decimal:2',
    ];

    public const STATUS_PENDING = 'pending';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_CANCELLED = 'cancelled';
    public const STATUS_COMPLETED = 'completed';

    /** Allowed status transitions: from => [to, ...] */
    public const ALLOWED_TRANSITIONS = [
        self::STATUS_PENDING   => [self::STATUS_CONFIRMED, self::STATUS_CANCELLED],
        self::STATUS_CONFIRMED => [self::STATUS_COMPLETED, self::STATUS_CANCELLED],
        self::STATUS_COMPLETED => [],
        self::STATUS_CANCELLED => [],
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Booking $model) {
            if (empty($model->reference)) {
                $model->reference = strtoupper(Str::random(8));
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }

    public function chauffeurService()
    {
        return $this->belongsTo(ChauffeurService::class, 'chauffeur_service_id');
    }

    /** Total guests (adults + kids) */
    public function getGuestsTotalAttribute(): int
    {
        return (int) $this->adults + (int) $this->kids;
    }

    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isConfirmed(): bool
    {
        return $this->status === self::STATUS_CONFIRMED;
    }

    public function isCancelled(): bool
    {
        return $this->status === self::STATUS_CANCELLED;
    }

    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    /** Whether transition to $newStatus is allowed from current status. */
    public function canTransitionTo(string $newStatus): bool
    {
        $allowed = self::ALLOWED_TRANSITIONS[$this->status] ?? [];
        return in_array($newStatus, $allowed, true);
    }

    /** Statuses that can be transitioned to from current status. */
    public function getAllowedNextStatuses(): array
    {
        return self::ALLOWED_TRANSITIONS[$this->status] ?? [];
    }
}
