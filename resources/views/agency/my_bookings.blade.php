@extends('agency.layouts.app')
@section('title')
Tour Bookings
@endsection
@section('content')

        <div class="flex justify-center">
            <div class="w-11/12 text-center">
                @if(session()->has('success'))
                    <div class="bg-green-500 text-white p-3 rounded mb-4">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="bg-yellow-500 text-white p-3 rounded mb-4">
                        {{ session()->get('error') }}
                    </div>
                @endif
            </div> 
        </div>
        
        <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4 my-10">
            @if($tours->count() > 0)
                @foreach($tours as $tour)
                    @if($tour->total_bookings > 0)
                        <div class="w-full border flex">
                            <div class="w-full bg-white shadow-lg rounded-lg overflow-hidden flex flex-col justify-between">
                                <div>
                                    <a href="{{ route('tour_details', $tour->id) }}">
                                        <img class="w-full h-40 object-cover" src="{{ asset($tour->trip_image) }}" alt="Tour Image">
                                    </a>
                                    <div class="p-3">
                                        <h3 class="text-md font-bold tracking-tight leading-6 text-[#008000]">{{ $tour->trip_name }}</h3>
                                        <div class="text-gray-600 text-sm my-2 ">Total Bookings: {{ $tour->total_bookings }}</div>
                                    </div>
                                </div>
                                <a href="{{ route('agency.tour_bookings', $tour->id) }}" class="bg-[#008000] text-white py-2 px-4 rounded block text-center text-md">View Bookings</a>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <h4 class="text-center text-lg font-semibold mt-6">No Tour Found!</h4>
            @endif
        </div>

      
      
@endsection

@section('script')

@endsection