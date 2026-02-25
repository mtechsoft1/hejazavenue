@extends('layouts.admin.app')
@section('content')
<div class="w-full max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Maid</h1>

    @if($errors->any())
        <div class="mb-4 p-4 rounded-lg bg-red-50 text-red-700 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.maid.update', $maid->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 space-y-5">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name', $maid->name) }}" required placeholder="Full name" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Phone <span class="text-red-500">*</span></label>
            <input type="text" name="phone" value="{{ old('phone', $maid->phone) }}" required placeholder="Phone number" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
            @if($maid->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $maid->image) }}" alt="{{ $maid->name }}" class="h-20 w-20 rounded-lg object-cover border border-gray-200">
                    <p class="mt-1 text-xs text-gray-500">Current photo. Upload a new file to replace.</p>
                </div>
            @endif
            <input type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            <p class="mt-1 text-xs text-gray-500">Optional. Max 5MB. JPG, PNG, GIF, WebP.</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email (optional)</label>
            <input type="email" name="email" value="{{ old('email', $maid->email) }}" placeholder="email@example.com" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nationality</label>
            <input type="text" name="nationality" value="{{ old('nationality', $maid->nationality) }}" placeholder="e.g. Philippines, Indonesia" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Experience (years)</label>
            <input type="number" name="experience_years" value="{{ old('experience_years', $maid->experience_years) }}" min="0" max="99" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="is_active" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="1" {{ (old('is_active', $maid->is_active) == 1) ? 'selected' : '' }}>✔ Active</option>
                <option value="0" {{ (old('is_active', $maid->is_active) == 0) ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 transition">Update Maid</button>
            <a href="{{ route('admin.maid.index') }}" class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">Cancel</a>
        </div>
    </form>
</div>
@endsection
