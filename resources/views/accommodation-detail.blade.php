@extends('layouts.app')
@section('title', $accommodation->title . ' - Accommodation')
@section('content')
@php
    $imgs = $accommodation->images;
    $count = $imgs->count();
    $main = $imgs->get(0);
    $topRight = $imgs->get(1);
    $bottomRight = $imgs->get(2);
    $placeholder = asset('images/hero.jpg');
@endphp
<section class="bg-[#FAFAF9]">
    {{-- Full-width: back + title (so card can start level with images) --}}
    <div class="max-w-7xl mx-auto px-6 pt-6 pb-2">
        <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-700 font-medium text-sm transition-colors">
            <i class="fa fa-arrow-left"></i> Back
        </a>
        <h1 class="text-3xl md:text-4xl font-semibold text-gray-900 mt-2">{{ $accommodation->title }}</h1>
        <div class="flex items-center gap-3 mt-3 flex-wrap">
            <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-emerald-50 text-gray-700 text-base font-medium">📍 {{ $accommodation->distance_display }}</span>
            <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-emerald-50 text-gray-700 text-base font-medium">👥 {{ $accommodation->guest_capacity_display }} People</span>
        </div>
    </div>

    {{-- Two columns: left = gallery + content, right = reservation card (card starts with images) --}}
    <div class="max-w-7xl mx-auto px-6 py-6 grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-10 items-start">
        {{-- LEFT: gallery then content --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- GALLERY: large left (2/3), narrow right stack (1/3) --}}
            <div class="space-y-2">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 md:gap-3">
                    <div class="md:col-span-2 md:row-span-2 relative min-h-[280px] md:min-h-[400px] bg-gray-200 rounded-xl overflow-hidden">
                        <img src="{{ $main ? $main->url : $placeholder }}" alt="{{ $accommodation->title }}" class="absolute inset-0 w-full h-full object-cover">
                    </div>
                    <div class="relative min-h-[136px] md:min-h-[194px] bg-gray-200 rounded-xl overflow-hidden">
                        <img src="{{ $topRight ? $topRight->url : ($main ? $main->url : $placeholder) }}" alt="{{ $accommodation->title }}" class="absolute inset-0 w-full h-full object-cover">
                    </div>
                    <div class="relative min-h-[136px] md:min-h-[194px] bg-gray-200 rounded-xl overflow-hidden">
                        <img src="{{ $bottomRight ? $bottomRight->url : ($topRight ? $topRight->url : $placeholder) }}" alt="{{ $accommodation->title }}" class="absolute inset-0 w-full h-full object-cover">
                    </div>
                </div>
                <div class="grid grid-cols-5 gap-2">
                    @php
                        $thumbImgs = $imgs->slice(3, 5)->values();
                        $extraCount = $count > 8 ? $count - 8 : 0;
                    @endphp
                    @for($i = 0; $i < 5; $i++)
                        @php
                            $thumb = $thumbImgs->get($i) ?? $imgs->get($i) ?? $main;
                            $thumbUrl = $thumb ? $thumb->url : $placeholder;
                            $showMoreOverlay = ($i === 4 && $extraCount > 0);
                        @endphp
                        <div class="relative aspect-[4/3] rounded-xl overflow-hidden bg-gray-200">
                            <img src="{{ $thumbUrl }}" alt="{{ $accommodation->title }}" class="absolute inset-0 w-full h-full object-cover">
                            @if($showMoreOverlay)
                                <a href="#gallery" class="absolute inset-0 flex items-center justify-center bg-black/50 hover:bg-black/60 transition-colors rounded-xl">
                                    <span class="text-white font-semibold text-sm md:text-base">+{{ $extraCount }} photos</span>
                                </a>
                            @endif
                        </div>
                    @endfor
                </div>
            </div>

            {{-- Full gallery anchor / optional expand --}}
            @if($count > 8)
                <div id="gallery" class="grid grid-cols-2 sm:grid-cols-3 gap-3 rounded-2xl overflow-hidden">
                    @foreach($accommodation->images as $img)
                        <img src="{{ $img->url }}" alt="{{ $accommodation->title }}" class="w-full aspect-[4/3] object-cover rounded-lg">
                    @endforeach
                </div>
            @endif

            {{-- FEATURES --}}
            <div class="rounded-2xl bg-emerald-50/80 border border-emerald-100 p-2">
                <h2 class="text-xl font-semibold text-gray-900 mb-3 flex items-center gap-2">
                    <i class="fa fa-star text-emerald-600"></i>
                    What this place offers
                </h2>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    <div class="flex items-center gap-3 rounded-xl bg-white/80 border border-emerald-100 px-4 py-3 text-sm text-gray-700 shadow-sm">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600"><i class="fa fa-bed"></i></span>
                        <span class="font-medium">{{ $accommodation->bedrooms }} Bedrooms</span>
                    </div>
                    <div class="flex items-center gap-3 rounded-xl bg-white/80 border border-emerald-100 px-4 py-3 text-sm text-gray-700 shadow-sm">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600"><i class="fa fa-bath"></i></span>
                        <span class="font-medium">{{ $accommodation->bathrooms ?? 0 }} Bathrooms</span>
                    </div>
                    <div class="flex items-center gap-3 rounded-xl bg-white/80 border border-emerald-100 px-4 py-3 text-sm text-gray-700 shadow-sm">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600"><i class="fa fa-user"></i></span>
                        <span class="font-medium">Dedicated Maid Included</span>
                    </div>
                    <div class="flex items-center gap-3 rounded-xl bg-white/80 border border-emerald-100 px-4 py-3 text-sm text-gray-700 shadow-sm">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600"><i class="fa fa-car"></i></span>
                        <span class="font-medium">Driver Included</span>
                    </div>
                    <div class="flex items-center gap-3 rounded-xl bg-white/80 border border-emerald-100 px-4 py-3 text-sm text-gray-700 shadow-sm">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600"><i class="fa fa-taxi"></i></span>
                        <span class="font-medium">Chauffeur Included</span>
                    </div>
                    <div class="flex items-center gap-3 rounded-xl bg-white/80 border border-emerald-100 px-4 py-3 text-sm text-gray-700 shadow-sm">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600"><i class="fa fa-cutlery"></i></span>
                        <span class="font-medium">Full Kitchen</span>
                    </div>
                    <div class="flex items-center gap-3 rounded-xl bg-white/80 border border-emerald-100 px-4 py-3 text-sm text-gray-700 shadow-sm">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600"><i class="fa fa-home"></i></span>
                        <span class="font-medium">Living Room</span>
                    </div>
                    <div class="flex items-center gap-3 rounded-xl bg-white/80 border border-emerald-100 px-4 py-3 text-sm text-gray-700 shadow-sm">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600"><i class="fa fa-wifi"></i></span>
                        <span class="font-medium">WiFi</span>
                    </div>
                    <div class="flex items-center gap-3 rounded-xl bg-white/80 border border-emerald-100 px-4 py-3 text-sm text-gray-700 shadow-sm">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600"><i class="fa fa-thermometer"></i></span>
                        <span class="font-medium">AC</span>
                    </div>
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
                        <span class="inline-block mb-2 px-3 py-1 text-xs bg-green-100 text-green-700 rounded-full">
                            INCLUDED
                        </span>
                        <h3 class="font-semibold mb-2 flex items-center gap-2"><i class="fa fa-car text-emerald-600"></i> Personal Driver</h3>
                        <p class="text-sm text-gray-600">
                            A dedicated driver at your service for local trips, airport transfers, and exploring—so you travel in comfort and safety.
                        </p>
                    </div>
                </div>
            </div>

            {{-- TRAVEL LOGISTICS --}}
            <div>
                <h2 class="text-xl font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="fa fa-plane text-emerald-600"></i>
                    Travel Logistics
                </h2>

                <style>
                    #arrival_airport { appearance: none; -webkit-appearance: none; -moz-appearance: none; }
                    #arrival_airport::-ms-expand { display: none; }
                </style>
                <div class="bg-gray-100/80 rounded-2xl border border-gray-200 p-5 md:p-6 space-y-4">
                    <div class="space-y-2">
                        <label for="arrival_airport" class="text-lg font-semibold  flex items-center gap-2 text-gray-800">Arrival Airport</label>
                        <div class="relative">
                            <select id="arrival_airport" name="arrival_airport" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 transition outline-none cursor-pointer pr-10">
                                <option value="">Select Airport</option>
                                <option value="MED">Prince Mohammad Bin Abdulaziz Airport (Madinah)</option>
                                <option value="JED">King Abdulaziz International Airport (Jeddah)</option>
                                <option value="RUH">King Khalid International Airport (Riyadh)</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="checkin_date" class="text-lg font-semibold flex items-center gap-2 text-gray-800">Check-in Date</label>
                            <div class="relative">
                                <input type="date" id="checkin_date" name="checkin_date" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 transition outline-none pr-10"
                                       placeholder="mm/dd/yyyy">
                                <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-gray-400"><i class="fa fa-calendar-alt text-sm"></i></span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="flight_number" class="text-lg font-semibold flex items-center gap-2 text-gray-800">Flight Number</label>
                            <div class="relative">
                                <input type="text" id="flight_number" name="flight_number" placeholder="e.g. EK 807"
                                   class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 transition outline-none">
                                <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-gray-400"><i class="fa fa-plane text-sm"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CHAUFFEUR: default preselected, others in dropdown --}}
            <div class="chauffeur-section">
                <h2 class="text-xl font-semibold mb-4 flex items-center gap-2 text-gray-800">
                    <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600">
                        <i class="fa fa-car"></i>
                    </span>
                    Chauffeur Service
                </h2>

                @if($chauffeurServices->isNotEmpty())
                    {{-- Selected chauffeur card (default preselected) --}}
                    <div id="chauffeur-selected-card" class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden transition-all duration-200">
                        <div class="flex items-stretch min-h-[120px]">
                            <div class="w-28 flex-shrink-0 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center">
                                <i class="fa fa-car text-3xl text-gray-400"></i>
                            </div>
                            <div class="flex-1 p-5 flex flex-col justify-center">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span id="chauffeur-selected-name" class="font-semibold text-gray-900">
                                        {{ $defaultChauffeur ? $defaultChauffeur->name : $chauffeurServices->first()->name }}
                                    </span>
                                    @php $displayChauffeur = $defaultChauffeur ?? $chauffeurServices->first(); @endphp
                                    <span id="chauffeur-selected-badge" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $displayChauffeur->is_default ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                        {{ $displayChauffeur->is_default ? 'Included' : '+ SAR ' . number_format($displayChauffeur->extra_price, 0) . '/day' }}
                                    </span>
                                </div>
                                <p id="chauffeur-selected-desc" class="text-sm text-gray-500 mt-1" @if(!$displayChauffeur->capacity && !$displayChauffeur->description) style="display:none" @endif>
                                    {{ $displayChauffeur->capacity ?: $displayChauffeur->description }}
                                </p>
                                <p id="chauffeur-selected-price" class="text-sm mt-2 font-medium {{ $displayChauffeur->is_default ? 'text-emerald-600' : 'text-amber-600' }}">
                                    {{ $displayChauffeur->is_default ? 'Included in package' : '+ SAR ' . number_format($displayChauffeur->extra_price, 0) . ' / day' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Dropdown: change chauffeur (default preselected) --}}
                    <div class="mt-4">
                        <label for="chauffeur-select" class="block text-sm font-medium text-gray-700 mb-2">Choose chauffeur</label>
                        <select id="chauffeur-select" name="chauffeur_service_id" class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-gray-900 shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition outline-none appearance-none cursor-pointer bg-[length:20px] bg-[right_0.75rem_center] bg-no-repeat" style="background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 fill=%27none%27 viewBox=%270 0 24 24%27 stroke=%27%236b7280%27%3E%3Cpath stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%272%27 d=%27M19 9l-7 7-7-7%27/%3E%3C/svg%3E');">
                            @foreach($chauffeurServices as $chauffeur)
                                <option value="{{ $chauffeur->id }}"
                                        data-name="{{ $chauffeur->name }}"
                                        data-capacity="{{ $chauffeur->capacity ?? '' }}"
                                        data-description="{{ $chauffeur->description ?? '' }}"
                                        data-is-default="{{ $chauffeur->is_default ? '1' : '0' }}"
                                        data-extra-price="{{ $chauffeur->extra_price }}"
                                        {{ ($defaultChauffeur && $chauffeur->id === $defaultChauffeur->id) || (!$defaultChauffeur && $loop->first) ? 'selected' : '' }}>
                                    {{ $chauffeur->name }}
                                    @if($chauffeur->is_default)
                                        — Included
                                    @else
                                        — + SAR {{ number_format($chauffeur->extra_price, 0) }}/day
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var sel = document.getElementById('chauffeur-select');
                            var cardName = document.getElementById('chauffeur-selected-name');
                            var cardDesc = document.getElementById('chauffeur-selected-desc');
                            var cardPrice = document.getElementById('chauffeur-selected-price');
                            var cardBadge = document.getElementById('chauffeur-selected-badge');
                            if (!sel || !cardName) return;
                            function updateCard() {
                                var opt = sel.options[sel.selectedIndex];
                                if (!opt) return;
                                var name = opt.dataset.name || opt.text;
                                var capacity = opt.dataset.capacity || '';
                                var description = opt.dataset.description || '';
                                var isDefault = opt.dataset.isDefault === '1';
                                var extraPrice = parseFloat(opt.dataset.extraPrice || 0);
                                cardName.textContent = name;
                                if (cardDesc) {
                                    cardDesc.textContent = capacity || description || '';
                                    cardDesc.style.display = (capacity || description) ? '' : 'none';
                                }
                                if (cardBadge) {
                                    cardBadge.textContent = isDefault ? 'Included' : '+ SAR ' + (extraPrice ? Math.round(extraPrice).toLocaleString() : '0') + '/day';
                                    cardBadge.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ' + (isDefault ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800');
                                }
                                if (isDefault) {
                                    cardPrice.textContent = 'Included in package';
                                    cardPrice.className = 'text-sm mt-2 font-medium text-emerald-600';
                                } else {
                                    cardPrice.textContent = '+ SAR ' + (extraPrice ? Math.round(extraPrice).toLocaleString() : '0') + ' / day';
                                    cardPrice.className = 'text-sm mt-2 font-medium text-amber-600';
                                }
                            }
                            sel.addEventListener('change', updateCard);
                        });
                    </script>
                @else
                    <div class="bg-white rounded-2xl border border-gray-200 p-6 text-center text-gray-500 text-sm">
                        No chauffeur services available at the moment.
                    </div>
                @endif
            </div>

            {{-- SPECIAL REQUESTS --}}
            <div>
                <h2 class="text-xl font-semibold mb-6 flex items-center gap-2 text-gray-800">
                    <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600"><i class="fa fa-heart"></i></span>
                    Special Requests
                </h2>

                <div class="grid md:grid-cols-2 gap-4">
                    <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-sm">
                        <span class="font-medium text-gray-900">❤️ Elderly Support</span>
                        <p class="text-sm text-gray-600 mt-1">Care and extra attention</p>
                    </div>
                    <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-sm">
                        <span class="font-medium text-gray-900">♿ Accessibility</span>
                        <p class="text-sm text-gray-600 mt-1">Wheelchair optimized stay</p>
                    </div>
                </div>
            </div>

            {{-- AVAILABILITY: What's Included, Additional Info, Cancellation, FAQ --}}
            <div class="availability-section">
                <h2 class="text-xl font-semibold mb-4 flex items-center gap-2 text-gray-800">
                    <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600"><i class="fa fa-info-circle"></i></span>
                    Availability &amp; Policies
                </h2>

                <div class="border border-gray-200 rounded-2xl bg-white shadow-sm overflow-hidden divide-y divide-gray-100">
                    <div class="accordion-item">
                        <button type="button" class="availability-accordion-btn w-full flex items-center justify-between gap-3 px-5 py-4 text-left font-semibold text-gray-900 hover:bg-gray-50/80 transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:ring-inset" aria-expanded="true" aria-controls="accordion-included" id="accordion-btn-included" data-accordion="included">
                            <span class="flex items-center gap-2"><i class="fa fa-check-circle text-emerald-600 text-lg"></i> What's Included</span>
                            <i class="fa fa-chevron-down text-gray-400 text-sm transition-transform duration-200 accordion-chevron"></i>
                        </button>
                        <div id="accordion-included" class="accordion-panel px-5 pb-4" role="region" aria-labelledby="accordion-btn-included">
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-center gap-2"><i class="fa fa-check text-emerald-600 w-4"></i> Dedicated maid (daily cleaning)</li>
                                <li class="flex items-center gap-2"><i class="fa fa-check text-emerald-600 w-4"></i> Personal driver for transfers &amp; local trips</li>
                                <li class="flex items-center gap-2"><i class="fa fa-check text-emerald-600 w-4"></i> Chauffeur service (as per selected package)</li>
                                <li class="flex items-center gap-2"><i class="fa fa-check text-emerald-600 w-4"></i> WiFi &amp; AC</li>
                                <li class="flex items-center gap-2"><i class="fa fa-check text-emerald-600 w-4"></i> Full kitchen &amp; living area</li>
                                <li class="flex items-center gap-2"><i class="fa fa-check text-emerald-600 w-4"></i> Utilities &amp; maintenance</li>
                            </ul>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <button type="button" class="availability-accordion-btn w-full flex items-center justify-between gap-3 px-5 py-4 text-left font-semibold text-gray-900 hover:bg-gray-50/80 transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:ring-inset" aria-expanded="false" aria-controls="accordion-info" id="accordion-btn-info" data-accordion="info">
                            <span class="flex items-center gap-2"><i class="fa fa-file-alt text-emerald-600 text-lg"></i> Additional Information</span>
                            <i class="fa fa-chevron-down text-gray-400 text-sm transition-transform duration-200 accordion-chevron"></i>
                        </button>
                        <div id="accordion-info" class="accordion-panel hidden px-5 pb-4" role="region" aria-labelledby="accordion-btn-info">
                            <div class="text-sm text-gray-600 space-y-3">
                                <p><strong class="text-gray-800">Check-in:</strong> From 3:00 PM</p>
                                <p><strong class="text-gray-800">Check-out:</strong> Until 11:00 AM</p>
                                <p><strong class="text-gray-800">Guests:</strong> {{ $accommodation->guest_capacity_display }} people (min–max capacity)</p>
                                <p><strong class="text-gray-800">Pets:</strong> Not allowed</p>
                                <p>For early check-in or late check-out, please contact us in advance. Quiet hours are observed for the comfort of all guests.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <button type="button" class="availability-accordion-btn w-full flex items-center justify-between gap-3 px-5 py-4 text-left font-semibold text-gray-900 hover:bg-gray-50/80 transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:ring-inset" aria-expanded="false" aria-controls="accordion-cancel" id="accordion-btn-cancel" data-accordion="cancel">
                            <span class="flex items-center gap-2"><i class="fa fa-shield-alt text-emerald-600 text-lg"></i> Cancellation Policy</span>
                            <i class="fa fa-chevron-down text-gray-400 text-sm transition-transform duration-200 accordion-chevron"></i>
                        </button>
                        <div id="accordion-cancel" class="accordion-panel hidden px-5 pb-4" role="region" aria-labelledby="accordion-btn-cancel">
                            <div class="text-sm text-gray-600 space-y-2">
                                <p><strong class="text-gray-800">Free cancellation</strong> up to 7 days before check-in. Full refund will be processed within 5–7 business days.</p>
                                <p>If you cancel between 3–7 days before check-in, 50% of the total amount will be refunded.</p>
                                <p>Cancellations within 3 days of check-in are non-refundable. We recommend travel insurance for unexpected changes.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <button type="button" class="availability-accordion-btn w-full flex items-center justify-between gap-3 px-5 py-4 text-left font-semibold text-gray-900 hover:bg-gray-50/80 transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:ring-inset" aria-expanded="false" aria-controls="accordion-faq" id="accordion-btn-faq" data-accordion="faq">
                            <span class="flex items-center gap-2"><i class="fa fa-question-circle text-emerald-600 text-lg"></i> FAQ</span>
                            <i class="fa fa-chevron-down text-gray-400 text-sm transition-transform duration-200 accordion-chevron"></i>
                        </button>
                        <div id="accordion-faq" class="accordion-panel hidden px-5 pb-4" role="region" aria-labelledby="accordion-btn-faq">
                            <div class="text-sm text-gray-600 space-y-4">
                                <div>
                                    <p class="font-semibold text-gray-800 mb-1">Is airport pickup included?</p>
                                    <p>Yes. Your selected chauffeur service includes airport transfer. Share your flight details in the Travel Logistics section so we can coordinate.</p>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800 mb-1">What is the distance to Masjid an-Nabawi?</p>
                                    <p>{{ $accommodation->distance_display }}. We provide comfortable transport for your daily visits.</p>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800 mb-1">Can I request early check-in?</p>
                                    <p>Subject to availability. Contact us after booking and we will do our best to accommodate you.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var btns = document.querySelectorAll('.availability-accordion-btn');
                        btns.forEach(function(btn) {
                            btn.addEventListener('click', function() {
                                var expanded = this.getAttribute('aria-expanded') === 'true';
                                var targetId = this.getAttribute('aria-controls');
                                var panel = document.getElementById(targetId);
                                var chevron = this.querySelector('.accordion-chevron');
                                this.setAttribute('aria-expanded', !expanded);
                                if (panel) panel.classList.toggle('hidden', expanded);
                                if (chevron) chevron.style.transform = expanded ? '' : 'rotate(180deg)';
                                if (!expanded) {
                                    btns.forEach(function(b) {
                                        if (b !== btn) {
                                            b.setAttribute('aria-expanded', 'false');
                                            var id = b.getAttribute('aria-controls');
                                            var p = document.getElementById(id);
                                            var ch = b.querySelector('.accordion-chevron');
                                            if (p) p.classList.add('hidden');
                                            if (ch) ch.style.transform = '';
                                        }
                                    });
                                }
                            });
                        });
                        var firstBtn = document.querySelector('.availability-accordion-btn');
                        if (firstBtn) {
                            var ch = firstBtn.querySelector('.accordion-chevron');
                            if (ch) ch.style.transform = 'rotate(180deg)';
                        }
                    });
                </script>
            </div>
        </div>

        {{-- RIGHT SIDEBAR --}}
        <aside class="bg-white border rounded-3xl p-6 h-fit sticky top-20 overflow-hidden z-10">
            <h3 class="font-semibold text-lg mb-4">
                Reservation
            </h3>

            <p class="text-sm text-gray-600 mb-3">{{ $accommodation->city }}, Saudi Arabia</p>
            <div class="flex gap-3 mb-4 min-w-0">
                @php $thumb = $accommodation->images->first(); @endphp
                <img src="{{ $thumb ? $thumb->url : asset('images/room1.jpg') }}" alt="{{ $accommodation->title }}" class="w-16 h-16 shrink-0 rounded-lg object-cover">
                <div class="min-w-0">
                    <p class="font-medium text-[#1a1a1a] truncate">{{ $accommodation->title }}</p>
                    <p class="text-xs text-gray-500">{{ $accommodation->distance_display }}</p>
                </div>
            </div>

            <div class="space-y-3 mb-4">
                <div class="grid grid-cols-2 gap-2 min-w-0">
                    <input type="text" placeholder="Check-in" class="min-w-0 w-full border border-gray-300 rounded-xl px-3 py-2 text-sm box-border" readonly onfocus="this.type='date'">
                    <input type="text" placeholder="Check-out" class="min-w-0 w-full border border-gray-300 rounded-xl px-3 py-2 text-sm box-border" readonly onfocus="this.type='date'">
                </div>
            </div>

            <div class="space-y-4 text-sm">
                <div class="flex justify-between">
                    <span>Price per night (all included)</span>
                    <span>SAR {{ number_format($accommodation->price_per_night, 0) }}</span>
                </div>

                <div class="flex justify-between text-green-700">
                    <span>Dedicated Maid, Driver, Chauffeur</span>
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
