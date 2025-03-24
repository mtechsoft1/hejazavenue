@extends('user.layouts.app')
@section('title')
Tour Bookings
@endsection
@section('content')

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @if($tours->count() > 0)
            @foreach($tours as $tour)
                <div class="bg-white flex flex-col items-stretch  shadow-lg rounded-lg overflow-hidden">
                    <a href="{{ route('tour_details', $tour->tour_details->id) }}" class="block">
                        <figure class="relative">
                            <img class="w-full h-40 object-cover" src="{{ asset($tour->tour_details->trip_image) }}" alt="Tour Image">
                            <figcaption class="absolute bottom-0 bg-black bg-opacity-50 text-white text-sm p-2 w-full text-start">
                                {{ Str::limit($tour->tour_details->attractions, 15, ' ...') }}
                            </figcaption>
                        </figure>
                    </a>
                    <div class="p-4 h-full flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-semibold">{{ $tour->tour_details->trip_name }}</h3>
                            <p class="text-sm text-gray-600 flex items-center gap-2 mt-2">
                                <span class="fa fa-clock-o"></span>
                                <strong>Duration:</strong> {{ $tour->tour_details->trip_duration }}
                            </p>
                            <p class="text-sm text-gray-600 flex items-center gap-2 mt-2">
                                <span class="fa fa-address-card-o"></span>
                                <strong>Package:</strong> {{ $tour->package_type }}
                            </p>
                            <p class="text-sm text-gray-600 flex items-center gap-2 mt-2">
                                <span class="fa fa-usd"></span>
                                <strong>Price:</strong> {{ $tour->payment_amount }}
                            </p>
                        </div>
                        <div class="text-start mt-4">
                            <h6 class="font-semibold text-gray-700">Status: {{ $tour->status }}</h6>
                            <div class="mt-3">
                                @if($tour->status == 'completed')
                                    <a href="{{ route('user.submit_review', $tour->id) }}" >
                                    <button class="w-full bg-[#008000] text-white px-4 py-2 rounded hover:bg-green-600">Submit Review</button>
                                    </a>
                                @else
                                    <a href="{{ route('user.cancel_booking', $tour->id) }}">
                                        <button class="w-full bg-[#008000] text-white px-4 py-2 rounded hover:bg-green-600">Cancel Booking</button>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h4 class="text-center text-lg font-semibold">No Bookings Found!</h4>
        @endif
    </div>

      
@endsection

@section('script')

@endsection