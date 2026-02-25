@extends('layouts.admin.app')
@section('content')
<div class="w-full max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Driver: {{ $driver->name }}</h1>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.driver.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition">Back to list</a>
            <a href="{{ route('admin.driver.edit', $driver->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-amber-500 text-white text-sm font-medium rounded-lg hover:bg-amber-600 transition"><i class="fa fa-edit"></i> Edit</a>
            <form action="{{ route('admin.driver.destroy', $driver->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this driver?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition"><i class="fa fa-trash"></i> Delete</button>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 flex flex-col sm:flex-row gap-6">
            <div class="flex-shrink-0">
                @if($driver->image)
                    <img src="{{ asset('storage/' . $driver->image) }}" alt="{{ $driver->name }}" class="h-32 w-32 rounded-xl object-cover border border-gray-200">
                @else
                    <div class="h-32 w-32 rounded-xl bg-gray-200 flex items-center justify-center text-gray-500 text-4xl"><i class="fa fa-user"></i></div>
                @endif
            </div>
            <div class="flex-1 min-w-0">
                <table class="min-w-full divide-y divide-gray-200">
                    <tbody class="divide-y divide-gray-200">
                        <tr><th class="px-0 py-2 pr-4 text-left text-sm font-medium text-gray-500 w-40">Name</th><td class="px-0 py-2 text-sm text-gray-900">{{ $driver->name }}</td></tr>
                        <tr><th class="px-0 py-2 pr-4 text-left text-sm font-medium text-gray-500">Phone</th><td class="px-0 py-2 text-sm text-gray-900">{{ $driver->phone }}</td></tr>
                        <tr><th class="px-0 py-2 pr-4 text-left text-sm font-medium text-gray-500">Nationality</th><td class="px-0 py-2 text-sm text-gray-900">{{ $driver->nationality ?? '–' }}</td></tr>
                        <tr><th class="px-0 py-2 pr-4 text-left text-sm font-medium text-gray-500">License Number</th><td class="px-0 py-2 text-sm text-gray-900">{{ $driver->license_number ?? '–' }}</td></tr>
                        <tr><th class="px-0 py-2 pr-4 text-left text-sm font-medium text-gray-500">License Expiry</th><td class="px-0 py-2 text-sm text-gray-900">{{ $driver->license_expiry_date ? $driver->license_expiry_date->format('M d, Y') : '–' }}</td></tr>
                        <tr><th class="px-0 py-2 pr-4 text-left text-sm font-medium text-gray-500">Experience</th><td class="px-0 py-2 text-sm text-gray-900">{{ $driver->experience_years }} years</td></tr>
                        <tr><th class="px-0 py-2 pr-4 text-left text-sm font-medium text-gray-500">Languages</th><td class="px-0 py-2 text-sm text-gray-900">{{ $driver->languages_display }}</td></tr>
                        <tr><th class="px-0 py-2 pr-4 text-left text-sm font-medium text-gray-500">Status</th><td class="px-0 py-2">
                            @if($driver->is_active)
                                <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full bg-green-100 text-green-800">✔ Active</span>
                            @else
                                <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full bg-gray-100 text-gray-600">Inactive</span>
                            @endif
                        </td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
