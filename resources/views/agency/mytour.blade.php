@extends('agency.layouts.app')
@section('title')
My Tour
@endsection
@section('content')

        <div class="flex justify-center">
            <div class="w-11/12 text-center">
                @if(session()->has('success'))
                    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded mb-4">
                        {{ session()->get('error') }}
                    </div>
                @endif
            </div>
        </div>
        
        <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-3 my-10">
            @if($tours->count() > 0)
                @foreach($tours as $tour)
                    <div class="w-full border">
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                            <a href="{{ route('tour_details', $tour->id) }}" class="block relative">
                                <figure>
                                    <img class="w-full h-40 object-cover" src="{{ asset($tour->trip_image) }}" alt="Tour Image">
                                    <figcaption class="absolute bottom-0 left-0 bg-black bg-opacity-50 text-white px-3 py-1 text-sm">
                                        {{ Str::limit($tour->attractions, 20) }}
                                    </figcaption>
                                </figure>
                            </a>
                            <div class="p-3">
                                <h3 class="text-md tracking-tight leading-6 font-semibold text-[#008000]">{{ $tour->trip_name }}</h3>
                                <p class="text-gray-600 text-sm flex items-center mt-2">
                                    <i class="fa fa-clock-o mr-1"></i> <strong>Duration:</strong> {{ $tour->trip_duration }}
                                </p>
                                <div class="flex justify-between items-center mt-3">
                                    <div class="flex space-x-1 text-yellow-400">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half"></i>
                                    </div>
                                    <span class="text-gray-500 text-sm">(2 Reviews)</span>
                                </div>
                                <div class="mt-3 text-md text-end font-bold text-gray-800">
                                    <span>
                                        {{ $tour->pickup_points->per_seat_fare_currency ?? 'PKR' }}
                                        {{ $tour->pickup_points->per_seat_fare ?? '0.00' }}
                                    </span>
                                </div>
                                <div class="flex justify-between space-x-2 mt-3">
                                    <a class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure you want to delete?')" href="{{ route('agency.delete_tour', $tour->id) }}">
                                        <i class="fa fa-trash text-2xl"></i>
                                    </a>
                                    <a class="text-blue-600 hover:text-blue-800" href="{{ route('agency.edit_tour', $tour->id) }}">
                                        <i class="fa fa-edit text-2xl"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h4 class="text-center text-gray-700 w-full mt-4">No Tour Found!</h4>
            @endif
        </div>

      
      
@endsection

@section('script')

@endsection