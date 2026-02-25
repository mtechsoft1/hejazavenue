@extends('layouts.admin.app')
@section('content')
<div class="w-full max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Add Driver</h1>

    @if($errors->any())
        <div class="mb-4 p-4 rounded-lg bg-red-50 text-red-700 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.driver.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 space-y-5">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Full name" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Phone <span class="text-red-500">*</span></label>
            <input type="text" name="phone" value="{{ old('phone') }}" required placeholder="Phone number" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nationality</label>
            <input type="text" name="nationality" value="{{ old('nationality') }}" placeholder="e.g. Pakistan, Saudi Arabia" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
            <input type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            <p class="mt-1 text-xs text-gray-500">Optional. Max 5MB. JPG, PNG, GIF, WebP.</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">License Number</label>
            <input type="text" name="license_number" value="{{ old('license_number') }}" placeholder="License number" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">License Expiry Date</label>
            <input type="date" name="license_expiry_date" value="{{ old('license_expiry_date') }}" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Experience (Years)</label>
            <input type="number" name="experience_years" value="{{ old('experience_years', 0) }}" min="0" max="99" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Languages</label>
            <div class="flex flex-wrap gap-4 mt-2">
                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="languages[]" value="arabic" {{ in_array('arabic', old('languages', [])) ? 'checked' : '' }} class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                    <span class="text-sm text-gray-700">✔ Arabic</span>
                </label>
                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="languages[]" value="english" {{ in_array('english', old('languages', [])) ? 'checked' : '' }} class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                    <span class="text-sm text-gray-700">✔ English</span>
                </label>
                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="languages[]" value="urdu" {{ in_array('urdu', old('languages', [])) ? 'checked' : '' }} class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                    <span class="text-sm text-gray-700">✔ Urdu</span>
                </label>
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="is_active" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="1">✔ Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 transition">Add Driver</button>
            <a href="{{ route('admin.driver.index') }}" class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">Cancel</a>
        </div>
    </form>
</div>
@endsection
