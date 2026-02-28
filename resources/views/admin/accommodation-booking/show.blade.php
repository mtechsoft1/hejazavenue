@extends('layouts.admin.app')
@section('title', 'Booking ' . $booking->reference)
@section('content')
<div class="mx-auto max-w-4xl">
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Booking {{ $booking->reference }}</h1>
            <p class="mt-1 text-sm text-gray-500">Created {{ $booking->created_at->format('M j, Y \a\t H:i') }}</p>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('admin.accommodation_bookings.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                <i class="fa fa-arrow-left"></i> Back to list
            </a>
            @if($booking->status === 'pending')
                <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full bg-amber-100 text-amber-800">Pending</span>
            @elseif($booking->status === 'confirmed')
                <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full bg-blue-100 text-blue-800">Confirmed</span>
            @elseif($booking->status === 'completed')
                <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full bg-green-100 text-green-800">Completed</span>
            @else
                <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full bg-red-100 text-red-800">Cancelled</span>
            @endif
        </div>
    </div>

    {{-- Action buttons: POST with CSRF, only when transition allowed --}}
    @if($booking->getAllowedNextStatuses() !== [])
        <div class="mb-6 flex flex-wrap gap-3">
            @if($booking->canTransitionTo(\App\Booking::STATUS_CONFIRMED))
                <form action="{{ route('admin.accommodation_bookings.update_status', $booking) }}" method="POST" class="inline" onsubmit="return confirm('Confirm this booking?');">
                    @csrf
                    <input type="hidden" name="status" value="{{ \App\Booking::STATUS_CONFIRMED }}">
                    <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 transition">
                        <i class="fa fa-check"></i> Confirm
                    </button>
                </form>
            @endif
            @if($booking->canTransitionTo(\App\Booking::STATUS_COMPLETED))
                <form action="{{ route('admin.accommodation_bookings.update_status', $booking) }}" method="POST" class="inline" onsubmit="return confirm('Mark this booking as completed?');">
                    @csrf
                    <input type="hidden" name="status" value="{{ \App\Booking::STATUS_COMPLETED }}">
                    <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-green-700 transition">
                        <i class="fa fa-flag-checkered"></i> Complete
                    </button>
                </form>
            @endif
            @if($booking->canTransitionTo(\App\Booking::STATUS_CANCELLED))
                <form action="{{ route('admin.accommodation_bookings.update_status', $booking) }}" method="POST" class="inline" onsubmit="return confirm('Cancel this booking? This cannot be undone.');">
                    @csrf
                    <input type="hidden" name="status" value="{{ \App\Booking::STATUS_CANCELLED }}">
                    <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700 transition">
                        <i class="fa fa-times"></i> Cancel
                    </button>
                </form>
            @endif
        </div>
    @endif

    <div class="space-y-6">
        {{-- User --}}
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">User</h2>
            @if($booking->user)
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">
                    <div><dt class="text-gray-500">Name</dt><dd class="font-medium text-gray-900">{{ $booking->user->name }}</dd></div>
                    <div><dt class="text-gray-500">Email</dt><dd class="font-medium text-gray-900">{{ $booking->user->email }}</dd></div>
                    @if($booking->user->phone)
                        <div><dt class="text-gray-500">Phone</dt><dd class="font-medium text-gray-900">{{ $booking->user->phone }}</dd></div>
                    @endif
                </dl>
            @else
                <p class="text-gray-500 text-sm">Guest booking (no account)</p>
            @endif
        </div>

        {{-- Accommodation --}}
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Accommodation</h2>
            <div class="flex gap-4">
                @if($booking->accommodation && $booking->accommodation->images->isNotEmpty())
                    <img src="{{ $booking->accommodation->images->first()->url }}" alt="" class="w-24 h-24 rounded-lg object-cover border border-gray-200">
                @endif
                <div>
                    <p class="font-medium text-gray-900">{{ $booking->accommodation->title ?? '–' }}</p>
                    <p class="text-sm text-gray-500">{{ $booking->accommodation->distance_display ?? '' }}</p>
                    <p class="text-sm text-gray-600">{{ $booking->accommodation->city ?? '' }}, Saudi Arabia</p>
                </div>
            </div>
        </div>

        {{-- Dates & guests --}}
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Dates &amp; guests</h2>
            <dl class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-sm">
                <div><dt class="text-gray-500">Check-in</dt><dd class="font-medium text-gray-900">{{ $booking->check_in_date->format('D, M j, Y') }}</dd></div>
                <div><dt class="text-gray-500">Check-out</dt><dd class="font-medium text-gray-900">{{ $booking->check_out_date->format('D, M j, Y') }}</dd></div>
                <div><dt class="text-gray-500">Nights</dt><dd class="font-medium text-gray-900">{{ $booking->nights }}</dd></div>
                <div><dt class="text-gray-500">Guests</dt><dd class="font-medium text-gray-900">{{ $booking->adults }} adult(s), {{ $booking->kids }} kid(s)</dd></div>
            </dl>
        </div>

        {{-- Services --}}
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Services</h2>
            <ul class="space-y-2 text-sm text-gray-700">
                <li class="flex items-center gap-2"><i class="fa fa-check text-green-600 w-4"></i> Dedicated maid, driver — Included</li>
                @if($booking->chauffeurService)
                    <li class="flex items-center gap-2">
                        <i class="fa fa-car text-green-600 w-4"></i>
                        Chauffeur: {{ $booking->chauffeurService->name }}
                        @if($booking->chauffeur_price > 0)
                            — + SAR {{ number_format($booking->chauffeur_price, 0) }} total
                        @else
                            — Included
                        @endif
                    </li>
                @else
                    <li class="flex items-center gap-2"><i class="fa fa-car text-green-600 w-4"></i> Chauffeur — Included</li>
                @endif
                @if($booking->arrival_airport)
                    <li class="flex items-center gap-2"><i class="fa fa-plane text-green-600 w-4"></i> Arrival: {{ $booking->arrival_airport }}</li>
                @endif
                @if($booking->flight_number)
                    <li class="flex items-center gap-2"><i class="fa fa-plane text-green-600 w-4"></i> Flight: {{ $booking->flight_number }}</li>
                @endif
            </ul>
        </div>

        {{-- Price breakdown (read-only) --}}
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Price breakdown</h2>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between text-gray-700">
                    <span>SAR {{ number_format($booking->price_per_night, 0) }} × {{ $booking->nights }} night(s)</span>
                    <span>SAR {{ number_format($booking->price_per_night * $booking->nights, 0) }}</span>
                </div>
                @if($booking->chauffeur_price > 0)
                    <div class="flex justify-between text-gray-700">
                        <span>Chauffeur upgrade</span>
                        <span>SAR {{ number_format($booking->chauffeur_price, 0) }}</span>
                    </div>
                @endif
                <hr class="my-3 border-gray-200">
                <div class="flex justify-between font-semibold text-gray-900">
                    <span>Total</span>
                    <span>SAR {{ number_format($booking->total_price, 0) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
