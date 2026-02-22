@extends('layouts.app')
@section('title', $accommodation['title'] . ' - Accommodation')
@section('content')

<section class="bg-[#FAFAF9]">
    {{-- HERO --}}
    <div class="relative h-[420px]">
        <img src="{{ asset('images/hero.jpg') }}"
             class="absolute inset-0 w-full h-full object-cover"
             alt="{{ $accommodation['title'] }}">

        <div class="absolute inset-0 bg-black/30"></div>

        <div class="relative max-w-7xl mx-auto px-6 h-full flex items-end pb-12">
            <div class="text-white">
                <a href="{{ url()->previous() }}" class="inline-flex items-center gap-1 text-white/90 hover:text-white text-sm mb-4">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
                <div class="flex items-center gap-2 text-sm mb-2">
                    <span class="text-green-400">★ {{ $accommodation['rating'] }}</span>
                    <span>· {{ $accommodation['reviews'] }} Reviews</span>
                </div>

                <h1 class="text-4xl font-semibold mb-3">
                    {{ $accommodation['title'] }}
                </h1>

                <div class="flex items-center gap-6 text-sm text-white/90">
                    <span>📍 {{ $accommodation['distance'] }}</span>
                    <span>👥 {{ $accommodation['capacity'] }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 lg:grid-cols-3 gap-10">

        {{-- LEFT --}}
        <div class="lg:col-span-2 space-y-10">

            {{-- GALLERY --}}
            <div class="grid grid-cols-2 gap-6">
                <img src="{{ asset('images/room1.jpg') }}"
                     class="rounded-2xl object-cover w-full h-[260px]"
                     alt="Room 1">
                <img src="{{ asset('images/room2.jpg') }}"
                     class="rounded-2xl object-cover w-full h-[260px]"
                     alt="Room 2">
            </div>

            {{-- FEATURES --}}
            <div>
                <h2 class="text-xl font-semibold mb-6">
                    What this place offers
                </h2>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
                    @foreach ($accommodation['features'] as $item)
                        <div class="flex items-center gap-2">
                            <span class="text-green-600">✔</span>
                            <span>{{ $item }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- STAFF SERVICES --}}
            <div>
                <h2 class="text-xl font-semibold mb-6 flex items-center gap-2">
                    🧑‍💼 Staff Services
                </h2>

                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-white p-6 rounded-2xl border">
                        <span class="inline-block mb-2 px-3 py-1 text-xs bg-green-100 text-green-700 rounded-full">
                            INCLUDED
                        </span>
                        <h3 class="font-semibold mb-2">Dedicated Maid</h3>
                        <p class="text-sm text-gray-600">
                            Personalized daily cleaning and property management to ensure your stay is effortless and exceptional.
                        </p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border">
                        <span class="text-sm text-green-700 font-medium">
                            + SAR 400 / day
                        </span>
                        <h3 class="font-semibold mt-2 mb-2">Private Chef</h3>
                        <p class="text-sm text-gray-600">
                            Savor authentic Saudi cuisine and international dishes prepared fresh in your villa by our expert chefs.
                        </p>
                    </div>
                </div>
            </div>

            {{-- TRAVEL LOGISTICS --}}
            <div>
                <h2 class="text-xl font-semibold mb-6 flex items-center gap-2">
                    ✈ Travel Logistics
                </h2>

                <div class="bg-white p-6 rounded-2xl border grid md:grid-cols-2 gap-4">
                    <select class="w-full border rounded-xl px-4 py-3">
                        <option>Select Airport</option>
                    </select>

                    <input type="date"
                           class="w-full border rounded-xl px-4 py-3">

                    <input type="text"
                           placeholder="Flight Number (e.g EK 807)"
                           class="md:col-span-2 w-full border rounded-xl px-4 py-3">
                </div>
            </div>

            {{-- CHAUFFEUR --}}
            <div>
                <h2 class="text-xl font-semibold mb-6 flex items-center gap-2">
                    🚗 Chauffeur Service
                </h2>

                <div class="grid md:grid-cols-2 gap-6">
                    @foreach ([
                        ['Economy Sedan', 'Up to 4 passengers', 'SAR 300/day'],
                        ['SUV', 'Up to 6 passengers', 'SAR 500/day'],
                        ['Luxury Sedan', 'Up to 4 passengers', 'SAR 700/day'],
                        ['Family Van', 'Up to 8 passengers', 'SAR 800/day'],
                    ] as $car)
                        <div class="bg-white border rounded-2xl overflow-hidden">
                            <img src="{{ asset('images/car.jpg') }}"
                                 class="h-40 w-full object-cover"
                                 alt="{{ $car[0] }}">
                            <div class="p-4">
                                <h3 class="font-semibold">{{ $car[0] }}</h3>
                                <p class="text-sm text-gray-600">{{ $car[1] }}</p>
                                <span class="text-green-700 text-sm font-medium">
                                    {{ $car[2] }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- SPECIAL REQUESTS --}}
            <div>
                <h2 class="text-xl font-semibold mb-6">
                    📋 Special Requests
                </h2>

                <div class="grid md:grid-cols-2 gap-4">
                    <div class="border rounded-xl p-4 bg-white">
                        <span class="font-medium">❤️ Elderly Support</span>
                        <p class="text-sm text-gray-600 mt-1">Care and extra attention</p>
                    </div>
                    <div class="border rounded-xl p-4 bg-white">
                        <span class="font-medium">♿ Accessibility</span>
                        <p class="text-sm text-gray-600 mt-1">Wheelchair optimized stay</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- RIGHT SIDEBAR --}}
        <aside class="bg-white border rounded-3xl p-6 h-fit sticky top-10">
            <h3 class="font-semibold text-lg mb-4">
                Reservation
            </h3>

            <p class="text-sm text-gray-600 mb-3">Madinah, Saudi Arabia</p>
            <div class="flex gap-3 mb-4">
                <img src="{{ asset('images/room1.jpg') }}" alt="{{ $accommodation['title'] }}" class="w-16 h-16 rounded-lg object-cover">
                <div>
                    <p class="font-medium text-[#1a1a1a]">{{ $accommodation['title'] }}</p>
                    <p class="text-xs text-gray-500">★ {{ $accommodation['rating'] }} / {{ $accommodation['reviews'] }} reviews</p>
                </div>
            </div>

            <div class="space-y-3 mb-4">
                <div class="flex gap-2">
                    <input type="text" placeholder="Check-in" class="flex-1 border rounded-xl px-3 py-2 text-sm" readonly onfocus="this.type='date'">
                    <input type="text" placeholder="Check-out" class="flex-1 border rounded-xl px-3 py-2 text-sm" readonly onfocus="this.type='date'">
                </div>
            </div>

            <div class="space-y-4 text-sm">
                <div class="flex justify-between">
                    <span>Base Accommodation</span>
                    <span>SAR {{ $accommodation['price'] }}</span>
                </div>

                <div class="flex justify-between text-green-700">
                    <span>Staff & Cleaning</span>
                    <span>Included</span>
                </div>

                <hr>

                <div class="flex justify-between font-semibold">
                    <span>Total</span>
                    <span>Inquiry</span>
                </div>

                <button class="w-full mt-4 bg-gray-200 py-3 rounded-xl text-gray-500 font-medium">
                    Reserve My Journey
                </button>

                <p class="text-xs text-center text-gray-400 mt-2">
                    Guided by Grace, Secured by Trust
                </p>
            </div>
        </aside>

    </div>
</section>

@endsection
