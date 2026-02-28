@extends('layouts.app')
@section('title', 'Booking Confirmed - ' . $booking->reference)
@section('content')
<section class="bg-[#FAFAF9] min-h-screen py-8 md:py-12 flex items-start justify-center">
    <div class="max-w-lg mx-auto px-4 sm:px-6 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 mb-6">
            <i class="fa fa-check text-2xl"></i>
        </div>
        <h1 class="text-2xl md:text-3xl font-semibold text-gray-900 mb-2">Booking confirmed</h1>
        <p class="text-gray-600 mb-6">Thank you. Your reservation has been received.</p>

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 mb-6 text-left">
            <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-100">
                <span class="text-sm text-gray-500">Booking reference</span>
                <span class="font-mono font-semibold text-gray-900 text-lg">{{ $booking->reference }}</span>
            </div>
            <p class="font-medium text-gray-900">{{ $booking->accommodation->title }}</p>
            <p class="text-sm text-gray-500 mt-0.5">{{ $booking->accommodation->distance_display }}</p>
            <dl class="mt-4 space-y-2 text-sm">
                <div class="flex justify-between">
                    <dt class="text-gray-500">Check-in</dt>
                    <dd class="font-medium text-gray-900">{{ $booking->check_in_date->format('M j, Y') }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-gray-500">Check-out</dt>
                    <dd class="font-medium text-gray-900">{{ $booking->check_out_date->format('M j, Y') }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-gray-500">Guests</dt>
                    <dd class="font-medium text-gray-900">{{ $booking->adults }} adult(s), {{ $booking->kids }} kid(s)</dd>
                </div>
                <div class="flex justify-between pt-2 border-t border-gray-100">
                    <dt class="text-gray-500">Total</dt>
                    <dd class="font-semibold text-gray-900">SAR {{ number_format($booking->total_price, 0) }}</dd>
                </div>
            </dl>
        </div>

        <p class="text-sm text-gray-600 mb-6">We will contact you shortly to complete the process. Please keep this reference for your records.</p>

        <a href="{{ route('accommodation.detail', $booking->accommodation->slug) }}" class="inline-block py-3 px-6 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-medium transition-colors">
            Back to accommodation
        </a>
        <a href="{{ route('index') }}" class="inline-block py-3 px-6 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium transition-colors ml-3">
            Home
        </a>

        <p class="text-xs text-gray-400 mt-8">Guided by Grace, Secured by Trust</p>
    </div>
</section>
@endsection
