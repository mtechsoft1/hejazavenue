<?php

namespace App\Services;

use App\TourBooking;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Booking business logic (Laravel 11 – professional structure).
 */
class BookingService
{
    public function __construct(
        protected TourBooking $booking
    ) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->booking->newQuery()
            ->with(['tour', 'user'])
            ->orderByDesc('id')
            ->paginate($perPage);
    }

    public function find(int $id): ?TourBooking
    {
        return $this->booking->with(['tour', 'user'])->find($id);
    }

    public function updateStatus(TourBooking $booking, string $status): bool
    {
        return $booking->update(['status' => $status]);
    }

    public function byUser(int $userId, int $perPage = 15): LengthAwarePaginator
    {
        return $this->booking->newQuery()
            ->where('user_id', $userId)
            ->with(['tour'])
            ->orderByDesc('id')
            ->paginate($perPage);
    }

    public function byTour(int $tourId, int $perPage = 15): LengthAwarePaginator
    {
        return $this->booking->newQuery()
            ->where('tour_id', $tourId)
            ->with(['user'])
            ->orderByDesc('id')
            ->paginate($perPage);
    }
}
