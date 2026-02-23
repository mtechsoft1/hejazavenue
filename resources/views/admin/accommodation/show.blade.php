@extends('layouts.admin.app')
@section('content')
<div class="w-full max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <h1 class="text-2xl font-bold text-gray-800">{{ $accommodation->title }}</h1>
        <div class="flex gap-2">
            <a href="{{ route('admin.accommodation.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition">Back to list</a>
            <a href="{{ route('admin.accommodation.edit', $accommodation->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-amber-500 text-white text-sm font-medium rounded-lg hover:bg-amber-600 transition"><i class="fa fa-edit"></i> Edit</a>
            <form action="{{ route('admin.accommodation.destroy', $accommodation->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure? This will delete the accommodation and all its images.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition"><i class="fa fa-trash"></i> Delete</button>
            </form>
        </div>
    </div>

    @if(session()->has('message'))
        <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-800">{{ session()->get('message') }}</div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 space-y-6">
            @if($accommodation->images->isNotEmpty())
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 mb-3">Images</h2>
                    <div class="flex flex-wrap gap-4">
                        @foreach($accommodation->images as $img)
                            <div class="relative">
                                <img src="{{ $img->url }}" alt="" class="w-32 h-32 rounded-lg object-cover border border-gray-200">
                                @if($img->is_primary)
                                    <span class="absolute top-1 left-1 px-2 py-0.5 text-xs font-medium rounded bg-green-600 text-white">Primary</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <tbody class="divide-y divide-gray-200">
                        <tr><th class="px-0 py-2 text-left text-sm font-medium text-gray-500 w-40">Title</th><td class="py-2 text-sm text-gray-900">{{ $accommodation->title }}</td></tr>
                        <tr><th class="px-0 py-2 text-left text-sm font-medium text-gray-500">Slug</th><td class="py-2 text-sm text-gray-600">{{ $accommodation->slug }}</td></tr>
                        <tr><th class="px-0 py-2 text-left text-sm font-medium text-gray-500">Type</th><td class="py-2 text-sm text-gray-900">{{ $accommodation->type }}</td></tr>
                        <tr><th class="px-0 py-2 text-left text-sm font-medium text-gray-500">City</th><td class="py-2 text-sm text-gray-900">{{ $accommodation->city }}</td></tr>
                        <tr><th class="px-0 py-2 text-left text-sm font-medium text-gray-500">Distance</th><td class="py-2 text-sm text-gray-900">{{ $accommodation->distance_display }}</td></tr>
                        <tr><th class="px-0 py-2 text-left text-sm font-medium text-gray-500">Latitude / Longitude</th><td class="py-2 text-sm text-gray-600">{{ $accommodation->latitude ?? '–' }} / {{ $accommodation->longitude ?? '–' }}</td></tr>
                        <tr><th class="px-0 py-2 text-left text-sm font-medium text-gray-500">Bedrooms</th><td class="py-2 text-sm text-gray-900">{{ $accommodation->bedrooms }}</td></tr>
                        <tr><th class="px-0 py-2 text-left text-sm font-medium text-gray-500">Guests (min–max)</th><td class="py-2 text-sm text-gray-900">{{ $accommodation->guest_capacity_display }}</td></tr>
                        <tr><th class="px-0 py-2 text-left text-sm font-medium text-gray-500">Dedicated Maid</th><td class="py-2 text-sm text-gray-900">✔ Included</td></tr>
                        <tr><th class="px-0 py-2 text-left text-sm font-medium text-gray-500">Driver</th><td class="py-2 text-sm text-gray-900">✔ Included</td></tr>
                        <tr><th class="px-0 py-2 text-left text-sm font-medium text-gray-500">Chauffeur</th><td class="py-2 text-sm text-gray-900">✔ Included</td></tr>
                        <tr><th class="px-0 py-2 text-left text-sm font-medium text-gray-500">Chauffeur Service</th><td class="py-2 text-sm text-gray-900">{{ $accommodation->chauffeurService ? $accommodation->chauffeurService->name : '–' }}</td></tr>
                        <tr><th class="px-0 py-2 text-left text-sm font-medium text-gray-500">Price per night (SAR)</th><td class="py-2 text-sm font-semibold text-gray-900">{{ number_format($accommodation->price_per_night, 2) }}</td></tr>
                        <tr><th class="px-0 py-2 text-left text-sm font-medium text-gray-500">Active</th><td class="py-2 text-sm text-gray-900">{{ $accommodation->is_active ? 'Yes' : 'No' }}</td></tr>
                        <tr><th class="px-0 py-2 text-left text-sm font-medium text-gray-500">Sort Order</th><td class="py-2 text-sm text-gray-900">{{ $accommodation->sort_order }}</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
