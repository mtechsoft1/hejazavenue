@extends('layouts.admin.app')
@section('title', 'Accommodation Bookings')
@section('content')
<div class="mx-auto max-w-7xl">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Accommodation Bookings</h1>
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
            <i class="fa fa-arrow-left"></i> Dashboard
        </a>
    </div>

    {{-- Filters --}}
    <form method="GET" action="{{ route('admin.accommodation_bookings.index') }}" class="mt-6 flex flex-wrap items-end gap-4 rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
        <div>
            <label for="status" class="block text-xs font-medium uppercase tracking-wider text-gray-500">Status</label>
            <select name="status" id="status" class="mt-1 block w-full min-w-[140px] rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20">
                <option value="">All</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>
        <div>
            <label for="date_from" class="block text-xs font-medium uppercase tracking-wider text-gray-500">Check-in from</label>
            <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}" class="mt-1 block w-full min-w-[140px] rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20">
        </div>
        <div>
            <label for="date_to" class="block text-xs font-medium uppercase tracking-wider text-gray-500">Check-out to</label>
            <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}" class="mt-1 block w-full min-w-[140px] rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20">
        </div>
        <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700 transition">
            <i class="fa fa-filter"></i> Apply
        </button>
        @if(request()->hasAny(['status', 'date_from', 'date_to']))
            <a href="{{ route('admin.accommodation_bookings.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">Clear</a>
        @endif
    </form>

    <div class="mt-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        @if($bookings->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Reference</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">User</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Accommodation</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Check-in</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Check-out</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Guests</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Total</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Status</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Created</th>
                            <th scope="col" class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($bookings as $b)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="whitespace-nowrap px-4 py-3 text-sm font-mono font-medium text-gray-900">{{ $b->reference }}</td>
                                <td class="px-4 py-3 text-sm text-gray-900">
                                    @if($b->user)
                                        <div>{{ $b->user->name }}</div>
                                        <div class="text-gray-500 text-xs">{{ $b->user->email }}</div>
                                    @else
                                        <span class="text-gray-400">Guest</span>
                                    @endif
                                </td>
                                <td class="max-w-[180px] px-4 py-3 text-sm text-gray-600 truncate" title="{{ $b->accommodation->title ?? '' }}">{{ $b->accommodation->title ?? '–' }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-600">{{ $b->check_in_date->format('M j, Y') }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-600">{{ $b->check_out_date->format('M j, Y') }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-600">{{ $b->adults + $b->kids }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-sm font-medium text-gray-900">SAR {{ number_format($b->total_price, 0) }}</td>
                                <td class="whitespace-nowrap px-4 py-3">
                                    @if($b->status === 'pending')
                                        <span class="inline-flex px-2.5 py-0.5 text-xs font-medium rounded-full bg-amber-100 text-amber-800">Pending</span>
                                    @elseif($b->status === 'confirmed')
                                        <span class="inline-flex px-2.5 py-0.5 text-xs font-medium rounded-full bg-blue-100 text-blue-800">Confirmed</span>
                                    @elseif($b->status === 'completed')
                                        <span class="inline-flex px-2.5 py-0.5 text-xs font-medium rounded-full bg-green-100 text-green-800">Completed</span>
                                    @else
                                        <span class="inline-flex px-2.5 py-0.5 text-xs font-medium rounded-full bg-red-100 text-red-800">Cancelled</span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-500">{{ $b->created_at->format('M j, Y H:i') }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-right">
                                    <a href="{{ route('admin.accommodation_bookings.show', $b) }}" class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-primary-600 hover:bg-primary-50 transition" title="View"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="border-t border-gray-200 bg-gray-50 px-4 py-3">
                {{ $bookings->links() }}
            </div>
        @else
            <div class="px-6 py-12 text-center text-gray-500">No accommodation bookings found.</div>
        @endif
    </div>
</div>
@endsection
