@extends('layouts.admin.app')
@section('content')
<div class="mx-auto max-w-7xl">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-2xl font-bold text-gray-900">Accommodations</h1>
        <a href="{{ route('admin.accommodation.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 transition">
            <i class="fa fa-plus"></i> Add Accommodation
        </a>
    </div>

    @if($accommodations->count() > 0)
        <div class="mt-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Image</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Title</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Type</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">City</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Distance</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Beds / Baths</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Guests</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Price/night</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Active</th>
                            <th scope="col" class="px-4 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($accommodations as $acc)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3">
                                    @php $img = $acc->images->first(); @endphp
                                    @if($img)
                                        <img src="{{ $img->url }}" alt="" class="w-14 h-14 rounded-lg object-cover border border-gray-200">
                                    @else
                                        <span class="w-14 h-14 rounded-lg bg-gray-200 flex items-center justify-center text-gray-400 text-xs">No img</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $acc->title }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $acc->type }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $acc->city }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $acc->distance_display }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $acc->bedrooms }} / {{ $acc->bathrooms ?? 0 }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $acc->guest_capacity_display }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">SAR {{ number_format($acc->price_per_night, 0) }}</td>
                                <td class="px-4 py-3">
                                    @if($acc->is_active)
                                        <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full bg-primary-100 text-primary-800">Active</span>
                                    @else
                                        <span class="text-gray-400">No</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right space-x-2">
                                    <a href="{{ route('admin.accommodation.show', $acc->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-primary-600 hover:bg-primary-50 transition" title="View"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('admin.accommodation.edit', $acc->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-amber-600 hover:bg-amber-50 transition" title="Edit"><i class="fa fa-edit"></i></a>
                                    <form action="{{ route('admin.accommodation.destroy', $acc->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure? This will delete the accommodation and all its images.');">
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
                {{ $accommodations->links() }}
            </div>
        </div>
    @else
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
            <p class="text-gray-500 mb-4">No accommodations yet.</p>
            <a href="{{ route('admin.accommodation.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700">Add Accommodation</a>
        </div>
    @endif
</div>
@endsection
