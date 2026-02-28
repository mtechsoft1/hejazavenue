<?php

namespace App\Services;

use App\Booking;
use Illuminate\Support\Facades\DB;

/**
 * Handles accommodation booking status transitions with validation and transactions.
 * No financial fields are modified; ready for future payment_status, refund, activity log.
 */
class BookingStatusService
{
    /**
     * Whether the booking can transition to the given status.
     */
    public function canTransition(Booking $booking, string $newStatus): bool
    {
        return $booking->canTransitionTo($newStatus);
    }

    /**
     * Update booking status within a transaction. Only status is updated (no financial fields).
     *
     * @throws \InvalidArgumentException if transition is not allowed
     */
    public function transition(Booking $booking, string $newStatus): bool
    {
        if (!$this->canTransition($booking, $newStatus)) {
            throw new \InvalidArgumentException(
                "Transition from '{$booking->status}' to '{$newStatus}' is not allowed."
            );
        }

        $validStatuses = [
            Booking::STATUS_PENDING,
            Booking::STATUS_CONFIRMED,
            Booking::STATUS_CANCELLED,
            Booking::STATUS_COMPLETED,
        ];
        if (!in_array($newStatus, $validStatuses, true)) {
            throw new \InvalidArgumentException("Invalid status: {$newStatus}");
        }

        return DB::transaction(function () use ($booking, $newStatus) {
            $booking->update(['status' => $newStatus]);
            return true;
        });
    }
}
