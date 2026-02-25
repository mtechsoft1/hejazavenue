@extends('layouts.admin.app')
@section('content')
<div class="mx-auto max-w-7xl">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-2xl font-bold text-gray-900">Chauffeur Services</h1>
        <a href="{{ route('admin.chauffeur_service.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 transition">
            <i class="fa fa-plus"></i> Add Chauffeur
        </a>
    </div>

    @if($chauffeurServices->count() > 0)
        <div class="mt-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Capacity</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Vehicle No.</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Model</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Color</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Extra Price (SAR)</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Default</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Active</th>
                            <th scope="col" class="px-4 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($chauffeurServices as $cs)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $cs->name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $cs->capacity ?? '–' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $cs->vehicle_number ?? '–' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $cs->model ?? '–' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $cs->color ?? '–' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $cs->is_default ? 'Included' : number_format($cs->extra_price, 0) }}</td>
                                <td class="px-4 py-3">
                                    @if($cs->is_default)
                                        <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full bg-primary-100 text-primary-800">Default</span>
                                    @else
                                        <span class="text-gray-400">–</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $cs->is_active ? 'Yes' : 'No' }}</td>
                                <td class="px-4 py-3 text-right space-x-2">
                                    <a href="{{ route('admin.chauffeur_service.show', $cs->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-primary-600 hover:bg-primary-50 transition" title="View"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('admin.chauffeur_service.edit', $cs->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-amber-600 hover:bg-amber-50 transition" title="Edit"><i class="fa fa-edit"></i></a>
                                    <form action="{{ route('admin.chauffeur_service.destroy', $cs->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this chauffeur service?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-red-600 hover:bg-red-50 transition" title="Delete"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-3 border-t border-gray-200 bg-gray-50">
                {{ $chauffeurServices->links() }}
            </div>
        </div>
    @else
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
            <p class="text-gray-500 mb-4">No chauffeur services yet.</p>
            <a href="{{ route('admin.chauffeur_service.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700">Add Chauffeur</a>
        </div>
    @endif
</div>
@endsection
