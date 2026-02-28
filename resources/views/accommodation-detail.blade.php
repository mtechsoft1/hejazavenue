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
    {{-- Session flash (e.g. session expired, not available) --}}
    @if(session('error'))
        <div class="max-w-7xl mx-auto px-6 pt-6">
            <div class="rounded-xl bg-red-50 border border-red-200 p-4 text-red-800 text-sm" role="alert">{{ session('error') }}</div>
        </div>
    @endif
    {{-- Validation errors (when redirected back from booking review) --}}
    @if($errors->any())
        <div class="max-w-7xl mx-auto px-6 pt-6">
            <div class="rounded-xl bg-amber-50 border border-amber-200 p-4 text-amber-800 text-sm" role="alert">
                <p class="font-medium">Please correct the following:</p>
                <ul class="list-disc list-inside mt-1 space-y-0.5">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
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
                                <input type="date" id="checkin_date" name="checkin_date" value="{{ old('check_in_date') }}" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 transition outline-none pr-10"
                                       placeholder="mm/dd/yyyy" min="">
                                <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-gray-400"><i class="fa fa-calendar-alt text-sm"></i></span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="checkout_date_main" class="text-lg font-semibold flex items-center gap-2 text-gray-800">Check-out Date</label>
                            <div class="relative">
                                <input type="date" id="checkout_date_main" name="check_out_date" value="{{ old('check_out_date') }}" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 transition outline-none pr-10"
                                       placeholder="mm/dd/yyyy" min="">
                                <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-gray-400"><i class="fa fa-calendar-alt text-sm"></i></span>
                            </div>
                        </div>
                        <div class="md:col-span-2 space-y-2">
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
            <form id="booking-form" action="{{ route('accommodation.booking.storeReview', $accommodation->slug) }}" method="POST" class="space-y-0" data-accommodation-slug="{{ $accommodation->slug }}">
                @csrf
                <input type="hidden" name="accommodation_id" value="{{ $accommodation->id }}">
                <input type="hidden" name="check_in_date" id="form_check_in_date" value="">
                <input type="hidden" name="check_out_date" id="form_check_out_date" value="">
                <input type="hidden" name="arrival_airport" id="form_arrival_airport" value="">
                <input type="hidden" name="flight_number" id="form_flight_number" value="">
                <input type="hidden" name="chauffeur_service_id" id="form_chauffeur_service_id" value="{{ optional($defaultChauffeur ?? $chauffeurServices->first())->id ?? '' }}">

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
                        <input type="date" id="sidebar_checkin" name="_checkin_ui" value="{{ old('check_in_date') }}" class="min-w-0 w-full border border-gray-300 rounded-xl px-3 py-2 text-sm box-border" placeholder="Check-in" aria-label="Check-in date">
                        <input type="date" id="sidebar_checkout" name="_checkout_ui" value="{{ old('check_out_date') }}" class="min-w-0 w-full border border-gray-300 rounded-xl px-3 py-2 text-sm box-border" placeholder="Check-out" aria-label="Check-out date">
                    </div>
                    <div class="guest-selector">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Guests</label>
                        <div class="flex items-center gap-3 flex-wrap">
                            <div class="flex items-center gap-2">
                                <label for="guests_adults" class="text-xs text-gray-500">Adults</label>
                                <input type="number" id="guests_adults" name="adults" min="1" max="{{ $accommodation->max_guests }}" value="{{ old('adults', 1) }}" class="w-14 border border-gray-300 rounded-lg px-2 py-1.5 text-sm text-center">
                            </div>
                            <div class="flex items-center gap-2">
                                <label for="guests_kids" class="text-xs text-gray-500">Kids</label>
                                <input type="number" id="guests_kids" name="kids" min="0" max="{{ $accommodation->max_guests }}" value="{{ old('kids', 0) }}" class="w-14 border border-gray-300 rounded-lg px-2 py-1.5 text-sm text-center">
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Capacity: {{ $accommodation->min_guests }}–{{ $accommodation->max_guests }} guests</p>
                    </div>
                </div>

                <div id="booking-summary-msg" class="text-sm text-amber-600 mb-2 hidden" role="alert"></div>
                <div id="booking-availability-msg" class="text-sm mb-2 hidden" role="status"></div>

                <div class="space-y-4 text-sm">
                    <div class="flex justify-between">
                        <span>Price per night (all included)</span>
                        <span>SAR <span id="price_per_night_display">{{ number_format($accommodation->price_per_night, 0) }}</span></span>
                    </div>

                    <div class="flex justify-between text-green-700">
                        <span>Dedicated Maid, Driver, Chauffeur</span>
                        <span>Included</span>
                    </div>

                    <hr>

                    <div class="flex justify-between font-semibold">
                        <span>Total</span>
                        <span id="total_display">Select dates</span>
                    </div>

                    <button type="submit" id="btn_reserve" class="w-full mt-4 py-3 rounded-xl font-medium transition-colors disabled:opacity-50 disabled:cursor-not-allowed bg-gray-200 text-gray-500" disabled>
                        Reserve My Journey
                    </button>

                    <p class="text-xs text-center text-gray-400 mt-2">
                        Guided by Grace, Secured by Trust
                    </p>
                </div>
            </form>
        </aside>

    </div>
</section>

{{-- Booking sidebar: date sync, live price, validation, form submit sync --}}
<script>
(function() {
    var pricePerNight = {{ (float) $accommodation->price_per_night }};
    var minGuests = {{ (int) $accommodation->min_guests }};
    var maxGuests = {{ (int) $accommodation->max_guests }};
    var today = new Date().toISOString().slice(0, 10);

    var form = document.getElementById('booking-form');
    var sidebarCheckin = document.getElementById('sidebar_checkin');
    var sidebarCheckout = document.getElementById('sidebar_checkout');
    var mainCheckin = document.getElementById('checkin_date');
    var mainCheckout = document.getElementById('checkout_date_main');
    var formCheckIn = document.getElementById('form_check_in_date');
    var formCheckOut = document.getElementById('form_check_out_date');
    var formArrival = document.getElementById('form_arrival_airport');
    var formFlight = document.getElementById('form_flight_number');
    var formChauffeur = document.getElementById('form_chauffeur_service_id');
    var guestsAdults = document.getElementById('guests_adults');
    var guestsKids = document.getElementById('guests_kids');
    var chauffeurSelect = document.getElementById('chauffeur-select');
    var arrivalAirport = document.getElementById('arrival_airport');
    var flightNumber = document.getElementById('flight_number');
    var totalDisplay = document.getElementById('total_display');
    var summaryMsg = document.getElementById('booking-summary-msg');
    var btnReserve = document.getElementById('btn_reserve');

    function setMinDates() {
        if (sidebarCheckin) sidebarCheckin.setAttribute('min', today);
        if (mainCheckin) mainCheckin.setAttribute('min', today);
        if (mainCheckout) mainCheckout.setAttribute('min', today);
    }

    function syncCheckoutMin() {
        var ci = (sidebarCheckin && sidebarCheckin.value) || (mainCheckin && mainCheckin.value);
        if (ci) {
            var d = new Date(ci);
            d.setDate(d.getDate() + 1);
            var next = d.toISOString().slice(0, 10);
            if (sidebarCheckout) sidebarCheckout.setAttribute('min', next);
            if (mainCheckout) mainCheckout.setAttribute('min', next);
        }
    }

    function syncFromMainToSidebar() {
        if (mainCheckin && sidebarCheckin && mainCheckin.value) sidebarCheckin.value = mainCheckin.value;
        if (mainCheckout && sidebarCheckout && mainCheckout.value) sidebarCheckout.value = mainCheckout.value;
        syncCheckoutMin();
        updateSummary();
    }

    function syncFromSidebarToMain() {
        if (sidebarCheckin && mainCheckin && sidebarCheckin.value) mainCheckin.value = sidebarCheckin.value;
        if (sidebarCheckout && mainCheckout && sidebarCheckout.value) mainCheckout.value = sidebarCheckout.value;
        syncCheckoutMin();
        updateSummary();
    }

    function getChauffeurExtraPerNight() {
        if (!chauffeurSelect) return 0;
        var opt = chauffeurSelect.options[chauffeurSelect.selectedIndex];
        if (!opt || opt.dataset.isDefault === '1') return 0;
        return parseFloat(opt.dataset.extraPrice || 0) || 0;
    }

    function getCheckInOut() {
        var ci = (sidebarCheckin && sidebarCheckin.value) || (mainCheckin && mainCheckin.value);
        var co = (sidebarCheckout && sidebarCheckout.value) || (mainCheckout && mainCheckout.value);
        return { checkIn: ci, checkOut: co };
    }

    function parseDate(str) {
        if (!str) return null;
        var parts = str.split('-');
        if (parts.length !== 3) return null;
        return new Date(parseInt(parts[0], 10), parseInt(parts[1], 10) - 1, parseInt(parts[2], 10));
    }

    function nightsBetween(checkIn, checkOut) {
        var a = parseDate(checkIn);
        var b = parseDate(checkOut);
        if (!a || !b || b <= a) return 0;
        return Math.round((b - a) / (1000 * 60 * 60 * 24));
    }

    function updateSummary() {
        var msgEl = summaryMsg;
        var totalEl = totalDisplay;
        var btn = btnReserve;
        var ci = (sidebarCheckin && sidebarCheckin.value) || (mainCheckin && mainCheckin.value);
        var co = (sidebarCheckout && sidebarCheckout.value) || (mainCheckout && mainCheckout.value);
        var adults = guestsAdults ? parseInt(guestsAdults.value, 10) : 1;
        var kids = guestsKids ? parseInt(guestsKids.value, 10) : 0;
        var totalGuests = adults + kids;

        if (formCheckIn) formCheckIn.value = ci || '';
        if (formCheckOut) formCheckOut.value = co || '';

        var invalid = false;
        var message = '';

        if (!ci || !co) {
            if (totalEl) totalEl.textContent = 'Select dates';
            if (btn) btn.disabled = true;
            return;
        }
        if (ci < today) {
            invalid = true;
            message = 'Check-in cannot be in the past.';
        }
        if (co <= ci) {
            invalid = true;
            message = 'Check-out must be after check-in.';
        }
        if (totalGuests < minGuests || totalGuests > maxGuests) {
            invalid = true;
            message = 'Total guests must be between ' + minGuests + ' and ' + maxGuests + '.';
        }

        var nights = nightsBetween(ci, co);
        if (nights <= 0 && !invalid) {
            invalid = true;
            message = 'Please select valid dates.';
        }

        if (msgEl) {
            msgEl.textContent = message;
            msgEl.classList.toggle('hidden', !invalid);
        }

        if (invalid) {
            if (totalEl) totalEl.textContent = '—';
            if (btn) btn.disabled = true;
            if (window._availabilityAbort) window._availabilityAbort.abort();
            var availEl = document.getElementById('booking-availability-msg');
            if (availEl) { availEl.classList.add('hidden'); availEl.textContent = ''; }
            return;
        }

        var chauffeurExtra = getChauffeurExtraPerNight();
        var subtotal = pricePerNight * nights;
        var chauffeurTotal = chauffeurExtra * nights;
        var total = subtotal + chauffeurTotal;

        if (totalEl) {
            totalEl.textContent = 'SAR ' + Math.round(total).toLocaleString();
        }
        if (btn) {
            btn.disabled = false;
            btn.classList.remove('bg-gray-200', 'text-gray-500');
            btn.classList.add('bg-emerald-600', 'text-white', 'hover:bg-emerald-700');
        }

        fetchAvailability(ci, co);
    }

    var availabilityTimeout;
    function fetchAvailability(checkIn, checkOut) {
        var slug = form && form.getAttribute('data-accommodation-slug');
        if (!slug || !checkIn || !checkOut) return;
        clearTimeout(availabilityTimeout);
        availabilityTimeout = setTimeout(function() {
            if (window._availabilityAbort) window._availabilityAbort.abort();
            window._availabilityAbort = new AbortController();
            var url = '/accommodation/' + encodeURIComponent(slug) + '/availability?check_in=' + encodeURIComponent(checkIn) + '&check_out=' + encodeURIComponent(checkOut);
            var availEl = document.getElementById('booking-availability-msg');
            if (availEl) {
                availEl.classList.remove('hidden');
                availEl.textContent = 'Checking availability…';
                availEl.classList.remove('text-emerald-600', 'text-red-600');
            }
            fetch(url, { signal: window._availabilityAbort.signal, headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    if (!availEl) return;
                    availEl.classList.remove('hidden');
                    var reserveBtn = document.getElementById('btn_reserve');
                    if (data.available) {
                        availEl.textContent = 'Available';
                        availEl.classList.add('text-emerald-600');
                        availEl.classList.remove('text-red-600');
                        if (reserveBtn) reserveBtn.disabled = false;
                    } else {
                        availEl.textContent = data.message || 'Not available for these dates';
                        availEl.classList.add('text-red-600');
                        availEl.classList.remove('text-emerald-600');
                        if (reserveBtn) reserveBtn.disabled = true;
                    }
                })
                .catch(function() {
                    if (availEl) { availEl.classList.add('hidden'); availEl.textContent = ''; }
                });
        }, 400);
    }

    function syncHiddenBeforeSubmit() {
        if (formCheckIn) formCheckIn.value = (sidebarCheckin && sidebarCheckin.value) || (mainCheckin && mainCheckin.value) || '';
        if (formCheckOut) formCheckOut.value = (sidebarCheckout && sidebarCheckout.value) || (mainCheckout && mainCheckout.value) || '';
        if (formArrival && arrivalAirport) formArrival.value = arrivalAirport.value || '';
        if (formFlight && flightNumber) formFlight.value = flightNumber.value || '';
        if (formChauffeur && chauffeurSelect) formChauffeur.value = chauffeurSelect.value || '';
    }

    if (sidebarCheckin) {
        sidebarCheckin.addEventListener('change', syncFromSidebarToMain);
        sidebarCheckin.addEventListener('input', syncFromSidebarToMain);
    }
    if (sidebarCheckout) {
        sidebarCheckout.addEventListener('change', syncFromSidebarToMain);
        sidebarCheckout.addEventListener('input', syncFromSidebarToMain);
    }
    if (mainCheckin) {
        mainCheckin.addEventListener('change', syncFromMainToSidebar);
        mainCheckin.addEventListener('input', syncFromMainToSidebar);
    }
    if (mainCheckout) {
        mainCheckout.addEventListener('change', syncFromMainToSidebar);
        mainCheckout.addEventListener('input', syncFromMainToSidebar);
    }
    if (guestsAdults) { guestsAdults.addEventListener('change', updateSummary); guestsAdults.addEventListener('input', updateSummary); }
    if (guestsKids) { guestsKids.addEventListener('input', updateSummary); guestsKids.addEventListener('change', updateSummary); }
    if (chauffeurSelect) chauffeurSelect.addEventListener('change', function() {
        if (formChauffeur) formChauffeur.value = chauffeurSelect.value || '';
        updateSummary();
    });

    if (form) {
        form.addEventListener('submit', function() {
            syncHiddenBeforeSubmit();
        });
    }

    setMinDates();
    syncCheckoutMin();
    updateSummary();
})();
</script>

@endsection
