@extends('layouts.admin.app')
@section('content')
<div class="w-full max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Chauffeur Service: {{ $chauffeurService->name }}</h1>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.chauffeur_service.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition">Back to list</a>
            <a href="{{ route('admin.chauffeur_service.edit', $chauffeurService->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-amber-500 text-white text-sm font-medium rounded-lg hover:bg-amber-600 transition"><i class="fa fa-edit"></i> Edit</a>
            <form action="{{ route('admin.chauffeur_service.destroy', $chauffeurService->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this chauffeur service?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition"><i class="fa fa-trash"></i> Delete</button>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6">
            <table class="min-w-full divide-y divide-gray-200">
                <tbody class="divide-y divide-gray-200">
                    <tr><th class="px-4 py-3 text-left text-sm font-medium text-gray-500 w-40">Name</th><td class="px-4 py-3 text-sm text-gray-900">{{ $chauffeurService->name }}</td></tr>
                    <tr><th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Description</th><td class="px-4 py-3 text-sm text-gray-900">{{ $chauffeurService->description ?? '–' }}</td></tr>
                    <tr><th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Capacity</th><td class="px-4 py-3 text-sm text-gray-900">{{ $chauffeurService->capacity ?? '–' }}</td></tr>
                    <tr><th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Vehicle Number</th><td class="px-4 py-3 text-sm text-gray-900">{{ $chauffeurService->vehicle_number ?? '–' }}</td></tr>
                    <tr><th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Model</th><td class="px-4 py-3 text-sm text-gray-900">{{ $chauffeurService->model ?? '–' }}</td></tr>
                    <tr><th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Color</th><td class="px-4 py-3 text-sm text-gray-900">{{ $chauffeurService->color ?? '–' }}</td></tr>
                    <tr><th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Extra Price (SAR)</th><td class="px-4 py-3 text-sm text-gray-900">{{ $chauffeurService->is_default ? 'Included (default)' : number_format($chauffeurService->extra_price, 2) }}</td></tr>
                    <tr><th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Default</th><td class="px-4 py-3 text-sm text-gray-900">{{ $chauffeurService->is_default ? 'Yes' : 'No' }}</td></tr>
                    <tr><th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Active</th><td class="px-4 py-3 text-sm text-gray-900">{{ $chauffeurService->is_active ? 'Yes' : 'No' }}</td></tr>
                    <tr><th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Sort Order</th><td class="px-4 py-3 text-sm text-gray-900">{{ $chauffeurService->sort_order }}</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
