@extends('layouts.admin.app')
@section('content')
<div class="mx-auto max-w-7xl">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Tours</h1>
    </div>

    <div class="mt-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        @if($tours->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Company</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Provider</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Trip Name</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Image</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Start</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">End</th>
                            <th scope="col" class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($tours as $tour)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3 text-sm text-gray-900">{{ $tour->user->company_name ?? '–' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $tour->user->name ?? '–' }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $tour->trip_name }}</td>
                                <td class="whitespace-nowrap px-4 py-3">
                                    @if($tour->trip_image ?? null)
                                        <img src="{{ asset($tour->trip_image) }}" alt="" class="h-10 w-10 rounded-lg object-cover border border-gray-200">
                                    @else
                                        <span class="text-gray-400 text-sm">–</span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-600">{{ $tour->trip_start_date ?? '–' }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-600">{{ $tour->trip_end_date ?? '–' }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-right">
                                    <a href="{{ route('admin.tours.show', $tour->id) }}" class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-primary-600 hover:bg-primary-50 transition" title="View"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('admin.pickuppoint', $tour->id) }}" class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-primary-600 hover:bg-primary-50 transition ml-1" title="Pickup"><i class="fa fa-map-marker-alt"></i></a>
                                    <form action="{{ route('admin.tours.destroy', $tour->id) }}" method="POST" class="inline ml-1" onsubmit="return confirm('Are you sure you want to delete this tour?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-red-600 hover:bg-red-50 transition" title="Delete"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="border-t border-gray-200 bg-gray-50 px-4 py-3">
                {{ $tours->links() }}
            </div>
        @else
            <div class="px-6 py-12 text-center text-gray-500">No tours found.</div>
        @endif
    </div>
</div>
@endsection
