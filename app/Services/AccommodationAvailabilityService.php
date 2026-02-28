<?php

namespace App\Services;

use App\Accommodation;
use App\Booking;
use Carbon\Carbon;

/**
 * Accommodation availability logic.
 * An accommodation is unavailable if ANY confirmed booking overlaps the requested dates:
 *   booking.check_in < requested_check_out AND booking.check_out > requested_check_in
 * This logic is reused on the detail page (API) and on final booking confirmation (race-condition safe).
 */
class AccommodationAvailabilityService
{
    /**
     * Check if accommodation is available for the given date range.
     * Only confirmed bookings block availability; pending/cancelled do not.
     *
     * @param int $accommodationId
     * @param string $checkIn  Y-m-d
     * @param string $checkOut Y-m-d
     * @param int|null $excludeBookingId  Optional: exclude this booking (e.g. when editing)
     * @return bool  true = available, false = not available
     */
    public function isAvailable(int $accommodationId, string $checkIn, string $checkOut, ?int $excludeBookingId = null): bool
    {
        $query = Booking::query()
            ->where('accommodation_id', $accommodationId)
            ->where('status', Booking::STATUS_CONFIRMED)
            ->where('check_in_date', '<', $checkOut)
            ->where('check_out_date', '>', $checkIn);

        if ($excludeBookingId !== null) {
            $query->where('id', '!=', $excludeBookingId);
        }

        return !$query->exists();
    }

    /**
     * Same as isAvailable but throws if not available (for use at confirmation time).
     *
     * @throws \RuntimeException if not available
     */
    public function assertAvailable(int $accommodationId, string $checkIn, string $checkOut, ?int $excludeBookingId = null): void
    {
        if (!$this->isAvailable($accommodationId, $checkIn, $checkOut, $excludeBookingId)) {
            throw new \RuntimeException('This accommodation is no longer available for the selected dates. Please choose different dates.');
        }
    }

    /**
     * Validate date range: check_in < check_out and both are not in the past.
     *
     * @param string $checkIn  Y-m-d
     * @param string $checkOut Y-m-d
     * @return array  ['valid' => bool, 'message' => string|null]
     */
    public function validateDateRange(string $checkIn, string $checkOut): array
    {
        $today = Carbon::today()->format('Y-m-d');
        if ($checkIn < $today) {
            return ['valid' => false, 'message' => 'Check-in date cannot be in the past.'];
        }
        if ($checkOut <= $checkIn) {
            return ['valid' => false, 'message' => 'Check-out date must be after check-in date.'];
        }
        return ['valid' => true, 'message' => null];
    }
}
