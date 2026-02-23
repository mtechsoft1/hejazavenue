@extends('layouts.admin.app')
@section('content')
@php $d = $destinations[0] ?? null; @endphp
@if(!$d)
    <div class="rounded-lg bg-red-50 p-4 text-red-700">Destination not found.</div>
@else
<div class="mx-auto max-w-xl">
    <h1 class="text-2xl font-bold text-gray-900">Update Destination</h1>
    @if($errors->any())
        <div class="mt-4 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.destination.update', $d->id) }}" method="POST" enctype="multipart/form-data" class="mt-6 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        <div class="space-y-4">
            <div>
                <label for="destination_name" class="block text-sm font-medium text-gray-700">Destination Name</label>
                <input type="text" name="destination_name" id="destination_name" value="{{ old('destination_name', $d->destination_name) }}" placeholder="Destination Name" required class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20">
            </div>
            <div>
                <label for="destination_image" class="block text-sm font-medium text-gray-700">Destination Image</label>
                <input type="file" name="destination_image" id="destination_image" accept="image/*" class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20">
                <p class="mt-1 text-xs text-gray-500">Leave empty to keep current image.</p>
                @if($d->destination_image ?? null)
                    <img src="{{ asset($d->destination_image) }}" alt="" class="mt-2 h-20 rounded-lg border border-gray-200 object-cover">
                @endif
            </div>
            <div>
                <label for="is_public" class="block text-sm font-medium text-gray-700">Is Public</label>
                <select name="is_public" id="is_public" required class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20">
                    <option value="true" {{ (old('is_public', $d->is_public) == 'true') ? 'selected' : '' }}>Yes</option>
                    <option value="false" {{ (old('is_public', $d->is_public) == 'false') ? 'selected' : '' }}>No</option>
                </select>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 transition">Update</button>
                <a href="{{ route('admin.destination.index') }}" class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endif
@endsection
