@extends('layouts.admin.app')
@section('content')
<div class="mx-auto max-w-7xl">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Bookings</h1>
    </div>

    <div class="mt-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        @if($bookings->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">ID</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Tour</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">User</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Amount</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Status</th>
                            <th scope="col" class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($bookings as $booking)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="whitespace-nowrap px-4 py-3 text-sm font-medium text-gray-900">{{ $booking->id }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $booking->tour_detail->trip_name ?? '–' }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-600">{{ $booking->name }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-600">{{ $booking->payment_amount ?? '–' }}</td>
                                <td class="whitespace-nowrap px-4 py-3">
                                    <select onchange="location = this.options[this.selectedIndex].value;" class="rounded-lg border border-gray-300 bg-white px-2 py-1 text-xs font-medium focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20">
                                        <option value="{{ route('admin.update_booking_status', ['booking_id'=>$booking->id,'booking_status'=>'pending']) }}" @if($booking->status == 'pending') selected @endif>Pending</option>
                                        <option value="{{ route('admin.update_booking_status', ['booking_id'=>$booking->id,'booking_status'=>'cancelled']) }}" @if($booking->status == 'cancelled') selected @endif>Cancelled</option>
                                        <option value="{{ route('admin.update_booking_status', ['booking_id'=>$booking->id,'booking_status'=>'completed']) }}" @if($booking->status == 'completed') selected @endif>Completed</option>
                                    </select>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-right">
                                    <a href="{{ route('admin.bookings.show', $booking->id) }}" class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-primary-600 hover:bg-primary-50 transition" title="View"><i class="fa fa-eye"></i></a>
                                    <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" class="inline ml-1" onsubmit="return confirm('Are you sure you want to delete this booking?');">
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
                {{ $bookings->links() }}
            </div>
        @else
            <div class="px-6 py-12 text-center text-gray-500">No bookings found.</div>
        @endif
    </div>
</div>
@endsection
