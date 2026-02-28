<?php

namespace App\Http\Requests;

use App\Booking;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAccommodationBookingStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        $booking = $this->route('booking');
        if (!$booking instanceof Booking) {
            return false;
        }
        $status = $this->input('status');
        return $status && $booking->canTransitionTo($status);
    }

    public function rules(): array
    {
        $booking = $this->route('booking');
        $allowed = $booking instanceof Booking ? $booking->getAllowedNextStatuses() : [];

        return [
            'status' => [
                'required',
                'string',
                Rule::in($allowed),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'Please select a status.',
            'status.in'       => 'The selected status transition is not allowed.',
        ];
    }
}
