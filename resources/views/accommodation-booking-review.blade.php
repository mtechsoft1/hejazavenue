@extends('layouts.app')
@section('title', 'Review Your Booking - ' . $accommodation->title)
@section('content')
<section class="bg-[#FAFAF9] min-h-screen py-8 md:py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">
        <a href="{{ route('accommodation.detail', $accommodation->slug) }}" class="inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-700 font-medium text-sm transition-colors">
            <i class="fa fa-arrow-left"></i> Back to accommodation
        </a>
        <h1 class="text-2xl md:text-3xl font-semibold text-gray-900 mt-4 mb-2">Review your booking</h1>
        <p class="text-gray-600 text-sm md:text-base mb-8">Please confirm the details below before proceeding.</p>

        @if(session('error'))
            <div class="rounded-xl bg-red-50 border border-red-200 p-4 text-red-800 text-sm mb-6" role="alert">{{ session('error') }}</div>
        @endif

        @guest
            <div class="rounded-xl bg-amber-50 border border-amber-200 p-4 text-amber-800 text-sm mb-6 flex items-start gap-3" role="status">
                <span class="flex-shrink-0 mt-0.5"><i class="fa fa-info-circle text-amber-600"></i></span>
                <p class="font-medium">Please log in or register to confirm your booking. Your selection is saved—after signing in you can confirm without losing your dates or options.</p>
            </div>
        @endguest

        {{-- Accommodation summary --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mb-6">
            <div class="p-5 md:p-6 flex gap-4">
                @php $thumb = $accommodation->images->first(); @endphp
                <img src="{{ $thumb ? $thumb->url : asset('images/room1.jpg') }}" alt="{{ $accommodation->title }}" class="w-24 h-24 md:w-28 md:h-28 shrink-0 rounded-xl object-cover">
                <div class="min-w-0 flex-1">
                    <h2 class="font-semibold text-lg text-gray-900">{{ $accommodation->title }}</h2>
                    <p class="text-sm text-gray-500 mt-0.5">{{ $accommodation->distance_display }}</p>
                    <p class="text-sm text-gray-600 mt-2">{{ $accommodation->city }}, Saudi Arabia</p>
                </div>
            </div>
        </div>

        {{-- Dates & guests --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 md:p-6 mb-6">
            <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                <i class="fa fa-calendar-alt text-emerald-600"></i>
                Dates &amp; guests
            </h3>
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                <div>
                    <dt class="text-gray-500">Check-in</dt>
                    <dd class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($payload['check_in_date'])->format('D, M j, Y') }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500">Check-out</dt>
                    <dd class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($payload['check_out_date'])->format('D, M j, Y') }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500">Nights</dt>
                    <dd class="font-medium text-gray-900">{{ $payload['nights'] }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500">Guests</dt>
                    <dd class="font-medium text-gray-900">{{ $payload['adults'] }} adult(s), {{ $payload['kids'] }} kid(s)</dd>
                </div>
            </dl>
        </div>

        {{-- Services --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 md:p-6 mb-6">
            <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                <i class="fa fa-car text-emerald-600"></i>
                Services
            </h3>
            <ul class="space-y-2 text-sm text-gray-700">
                <li class="flex items-center gap-2"><i class="fa fa-check text-emerald-600 w-4"></i> Dedicated maid, driver — Included</li>
                @if($chauffeurService)
                    <li class="flex items-center gap-2">
                        <i class="fa fa-check text-emerald-600 w-4"></i>
                        Chauffeur: {{ $chauffeurService->name }}
                        @if($chauffeurService->is_default)
                            — Included
                        @else
                            — + SAR {{ number_format($payload['chauffeur_price'] ?? 0, 0) }} total
                        @endif
                    </li>
                @else
                    <li class="flex items-center gap-2"><i class="fa fa-check text-emerald-600 w-4"></i> Chauffeur — Included</li>
                @endif
                @if(!empty($payload['arrival_airport']))
                    <li class="flex items-center gap-2"><i class="fa fa-plane text-emerald-600 w-4"></i> Arrival: {{ $payload['arrival_airport'] }}</li>
                @endif
                @if(!empty($payload['flight_number']))
                    <li class="flex items-center gap-2"><i class="fa fa-plane text-emerald-600 w-4"></i> Flight: {{ $payload['flight_number'] }}</li>
                @endif
            </ul>
        </div>

        {{-- Price breakdown --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 md:p-6 mb-8">
            <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                <i class="fa fa-receipt text-emerald-600"></i>
                Price breakdown
            </h3>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between text-gray-700">
                    <span>SAR {{ number_format($payload['price_per_night'], 0) }} × {{ $payload['nights'] }} night(s)</span>
                    <span>SAR {{ number_format($payload['price_per_night'] * $payload['nights'], 0) }}</span>
                </div>
                @if(($payload['chauffeur_price'] ?? 0) > 0)
                    <div class="flex justify-between text-gray-700">
                        <span>Chauffeur upgrade</span>
                        <span>SAR {{ number_format($payload['chauffeur_price'], 0) }}</span>
                    </div>
                @endif
                <div class="flex justify-between text-green-700 pt-2">
                    <span>Maid, driver, default chauffeur</span>
                    <span>Included</span>
                </div>
                <hr class="my-3 border-gray-200">
                <div class="flex justify-between font-semibold text-base text-gray-900">
                    <span>Total</span>
                    <span>SAR {{ number_format($payload['total_price'], 0) }}</span>
                </div>
            </div>
        </div>

        {{-- Confirm form --}}
        <form action="{{ route('accommodation.booking.confirm') }}" method="POST" class="space-y-4">
            @csrf
            <button type="submit" class="w-full py-4 px-6 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-base transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                Confirm booking
            </button>
            <a href="{{ route('accommodation.detail', $accommodation->slug) }}" class="block text-center text-gray-600 hover:text-gray-900 text-sm font-medium">Edit dates or options</a>
        </form>

        <p class="text-center text-xs text-gray-400 mt-6">Guided by Grace, Secured by Trust</p>
    </div>
</section>
@endsection
