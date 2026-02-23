@extends('layouts.admin.app')
@section('content')
<div class="mx-auto max-w-7xl">
    <h1 class="text-2xl font-bold text-gray-900">User Reviews</h1>

    <div class="mt-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        @if($reviews->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">ID</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Company</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">User</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Rating</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Review</th>
                            <th scope="col" class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($reviews as $review)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="whitespace-nowrap px-4 py-3 text-sm font-medium text-gray-900">{{ $review->id }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-600">{{ $review->agency_details->company_name ?? '–' }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-600">{{ $review->user_details->name ?? '–' }}</td>
                                <td class="whitespace-nowrap px-4 py-3">
                                    <span class="text-primary-600">
                                        @for($i = 0; $i < $review->rating_stars; $i++)<i class="fa fa-star"></i>@endfor
                                    </span>
                                    @for($i = $review->rating_stars; $i < 5; $i++)<i class="fa fa-star-o text-gray-300"></i>@endfor
                                </td>
                                <td class="max-w-md px-4 py-3 text-sm text-gray-600">{{ $review->review }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-right">
                                    <a href="{{ route('admin.delete_review', $review->id) }}" onclick="return confirm('Are you sure you want to delete this review?');" class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-red-600 hover:bg-red-50 transition" title="Delete"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="border-t border-gray-200 bg-gray-50 px-4 py-3">
                {{ $reviews->links() }}
            </div>
        @else
            <div class="px-6 py-12 text-center text-gray-500">No reviews found.</div>
        @endif
    </div>
</div>
@endsection
