@extends('layouts.admin.app')
@section('content')
<div class="w-full max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Add Accommodation</h1>

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

    <form action="{{ route('admin.accommodation.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 space-y-5">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
            <input type="text" name="title" value="{{ old('title') }}" required placeholder="e.g. Deluxe Apartment" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Type <span class="text-red-500">*</span></label>
            <select name="type" required class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="Apartment" {{ old('type') === 'Apartment' ? 'selected' : '' }}>Apartment</option>
                <option value="Villa" {{ old('type') === 'Villa' ? 'selected' : '' }}>Villa</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
            <input type="text" name="city" value="{{ old('city', 'Madina') }}" placeholder="Madina" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Distance from Masjid an-Nabawi (meters) <span class="text-red-500">*</span></label>
            <input type="number" name="distance_meters" value="{{ old('distance_meters', 500) }}" min="0" required class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Latitude</label>
                <input type="text" name="latitude" value="{{ old('latitude') }}" placeholder="e.g. 24.4672" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Longitude</label>
                <input type="text" name="longitude" value="{{ old('longitude') }}" placeholder="e.g. 39.6111" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Bedrooms <span class="text-red-500">*</span></label>
                <input type="number" name="bedrooms" value="{{ old('bedrooms', 1) }}" min="0" required class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Min Guests <span class="text-red-500">*</span></label>
                <input type="number" name="min_guests" value="{{ old('min_guests', 1) }}" min="1" required class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Max Guests <span class="text-red-500">*</span></label>
                <input type="number" name="max_guests" value="{{ old('max_guests', 4) }}" min="1" required class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
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
                    <option value="{{ $cs->id }}" {{ old('chauffeur_service_id') == $cs->id ? 'selected' : '' }}>{{ $cs->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Price per night (SAR) <span class="text-red-500">*</span></label>
            <input type="number" name="price_per_night" value="{{ old('price_per_night') }}" min="0" step="0.01" required class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Active</label>
                <select name="is_active" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Images</label>
            <input type="file" name="images[]" multiple accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            <p class="mt-1 text-xs text-gray-500">You can select multiple images. First image will be primary.</p>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 transition">Create Accommodation</button>
            <a href="{{ route('admin.accommodation.index') }}" class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">Cancel</a>
        </div>
    </form>
</div>
@endsection
