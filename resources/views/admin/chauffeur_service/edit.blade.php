@extends('layouts.admin.app')
@section('content')
<div class="w-full max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Chauffeur Service</h1>

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

    <form action="{{ route('admin.chauffeur_service.update', $chauffeurService->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 space-y-5">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name', $chauffeurService->name) }}" required placeholder="e.g. Standard Sedan" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" rows="2" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $chauffeurService->description) }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Capacity</label>
            <input type="text" name="capacity" value="{{ old('capacity', $chauffeurService->capacity) }}" placeholder="e.g. Up to 4 passengers" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Vehicle Number</label>
            <input type="text" name="vehicle_number" value="{{ old('vehicle_number', $chauffeurService->vehicle_number) }}" placeholder="e.g. ABC 1234" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Model</label>
            <input type="text" name="model" value="{{ old('model', $chauffeurService->model) }}" placeholder="e.g. Toyota Camry" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Color</label>
            <input type="text" name="color" value="{{ old('color', $chauffeurService->color) }}" placeholder="e.g. White, Black" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Extra Price (SAR)</label>
            <input type="number" name="extra_price" value="{{ old('extra_price', $chauffeurService->extra_price) }}" min="0" step="0.01" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            <p class="mt-1 text-xs text-gray-500">0 = included in package (default service).</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Is Default (included in package)</label>
            <select name="is_default" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="0" {{ (old('is_default', $chauffeurService->is_default) == 0) ? 'selected' : '' }}>No</option>
                <option value="1" {{ (old('is_default', $chauffeurService->is_default) == 1) ? 'selected' : '' }}>Yes</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Active</label>
            <select name="is_active" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="1" {{ (old('is_active', $chauffeurService->is_active) == 1) ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ (old('is_active', $chauffeurService->is_active) == 0) ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $chauffeurService->sort_order) }}" min="0" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 transition">Update</button>
            <a href="{{ route('admin.chauffeur_service.index') }}" class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">Cancel</a>
        </div>
    </form>
</div>
@endsection
