@extends('layouts.admin.app')
@section('content')
<div class="w-full max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Accommodation</h1>

    @if(session()->has('message'))
        <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-800">{{ session()->get('message') }}</div>
    @endif
    @if(session()->has('error'))
        <div class="mb-4 p-4 rounded-lg bg-amber-100 text-amber-800">{{ session()->get('error') }}</div>
    @endif

    @if($errors->any())
        <div class="mb-4 p-4 rounded-lg bg-red-50 text-red-700 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.accommodation.update', $accommodation->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 space-y-5">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
            <input type="text" name="title" value="{{ old('title', $accommodation->title) }}" required placeholder="e.g. Deluxe Apartment" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Type <span class="text-red-500">*</span></label>
            <select name="type" required class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="Apartment" {{ old('type', $accommodation->type) === 'Apartment' ? 'selected' : '' }}>Apartment</option>
                <option value="Villa" {{ old('type', $accommodation->type) === 'Villa' ? 'selected' : '' }}>Villa</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
            <input type="text" name="city" value="{{ old('city', $accommodation->city) }}" placeholder="Madina" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Distance from Masjid an-Nabawi (meters) <span class="text-red-500">*</span></label>
            <input type="number" name="distance_meters" value="{{ old('distance_meters', $accommodation->distance_meters) }}" min="0" required class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Latitude</label>
                <input type="text" name="latitude" value="{{ old('latitude', $accommodation->latitude) }}" placeholder="e.g. 24.4672" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Longitude</label>
                <input type="text" name="longitude" value="{{ old('longitude', $accommodation->longitude) }}" placeholder="e.g. 39.6111" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Bedrooms <span class="text-red-500">*</span></label>
                <input type="number" name="bedrooms" value="{{ old('bedrooms', $accommodation->bedrooms) }}" min="0" required class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Min Guests <span class="text-red-500">*</span></label>
                <input type="number" name="min_guests" value="{{ old('min_guests', $accommodation->min_guests) }}" min="1" required class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Max Guests <span class="text-red-500">*</span></label>
                <input type="number" name="max_guests" value="{{ old('max_guests', $accommodation->max_guests) }}" min="1" required class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
        </div>
        <div class="p-3 bg-gray-50 rounded-lg border border-gray-200 text-sm text-gray-600">
            <strong>Included (locked ON):</strong> Dedicated Maid, Driver, Chauffeur — total price per night includes all.
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Chauffeur Service (from Chauffeur table)</label>
            <select name="chauffeur_service_id" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">— None —</option>
                @foreach($chauffeurServices as $cs)
                    <option value="{{ $cs->id }}" {{ old('chauffeur_service_id', $accommodation->chauffeur_service_id) == $cs->id ? 'selected' : '' }}>{{ $cs->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Price per night (SAR) <span class="text-red-500">*</span></label>
            <input type="number" name="price_per_night" value="{{ old('price_per_night', $accommodation->price_per_night) }}" min="0" step="0.01" required class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Active</label>
                <select name="is_active" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="1" {{ old('is_active', $accommodation->is_active) ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ !old('is_active', $accommodation->is_active) ? 'selected' : '' }}>No</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $accommodation->sort_order) }}" min="0" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
        </div>

        {{-- Existing images: primary + delete --}}
        @if($accommodation->images->isNotEmpty())
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Current Images</label>
                <div class="flex flex-wrap gap-4">
                    @foreach($accommodation->images as $img)
                        <div class="border border-gray-200 rounded-lg p-2 bg-gray-50">
                            <img src="{{ $img->url }}" alt="" class="w-24 h-24 rounded object-cover mb-2">
                            <label class="flex items-center gap-2 text-sm">
                                <input type="radio" name="primary_image_id" value="{{ $img->id }}" {{ $img->is_primary ? 'checked' : '' }} class="rounded text-indigo-600 focus:ring-indigo-500">
                                Primary
                            </label>
                            <label class="flex items-center gap-2 text-sm text-red-600 mt-1">
                                <input type="checkbox" name="delete_images[]" value="{{ $img->id }}" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                Delete
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Add More Images</label>
            <input type="file" name="images[]" multiple accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            <p class="mt-1 text-xs text-gray-500">Select additional images. Check "Delete" above to remove existing ones.</p>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 transition">Update Accommodation</button>
            <a href="{{ route('admin.accommodation.index') }}" class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">Cancel</a>
        </div>
    </form>
</div>
@endsection
