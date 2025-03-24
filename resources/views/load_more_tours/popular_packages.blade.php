<div class="mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 my-4">
    @foreach ($tours as $tour)
        <div class="relative flex flex-col shadow-md rounded-lg hover:bg-slate-100 transition duration-300">
            <a href="{{ route('tour_details', $tour->id) }}"
                class="rounded-t-lg text-decoration-none text-surface hover:text-black">
                <img class="rounded-t-lg w-full h-[210px] object-cover"
                    src="{{ asset($tour->trip_image)}}"
                    alt="{{ $tour->trip_name }}" />

                <div class="p-3 flex flex-col gap-3">
                    <div>
                        <span class="bg-[#008000] text-white p-1 text-sm rounded">Genius</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <h5 class="mb-2 text-sm font-bold leading-tight">{{ $tour->trip_name }}</h5>
                        <h5 class="text-sm font-normal text-gray-500 leading-tight">
                            <b>Trip Date:</b>
                            {{ \Carbon\Carbon::parse($tour->trip_start_date)->format('Y-m-d') }}
                        </h5>
                    </div>
                                        <div>
                        @if ($tour->pickup_points)
                            <p>{{ $tour->pickup_points->pickup_city  }}</p>
                        @endif
                    </div>
                    <div class="flex items-center gap-2">
                        @if($tour->rating)
                            <span
                                class="bg-[#009900] text-white p-1 text-sm rounded">{{ $tour->rating }}</span>
                                <div class="flex items-center space-x-2">
                            <span class="flex gap-1">
                                @foreach(range(1,5) as $i)
                                <span class="fa-stack" style="width:1em">
                                    @if(round($tour->rating) >= $i)
                                    <i class="fas fa-star fa-stack-1x" style="color:#FFDF00"></i>
                                    @else
                                    <i class="fas fa-star fa-stack-1x" style="color:black"></i>
                                    @endif
                                </span>
                                @endforeach
                            </span>
                        </div>                                       
                        <small class="text-gray-500">({{ $tour->reviews_count }} Reviews)</small>
                        
                        @endif

                    </div>
                    <div class="flex justify-between gap-1 items-center">
                        <h5 class="text-sm font-normal text-gray-500 leading-tight">
                            {{ $tour->trip_duration }}
                        </h5>
                        <div class="flex flex-col text-right">

                            <h1 class="text-md font-bold">
                                @if (isset($tour->pickup_points->per_seat_fare_currency))
                                    {{ $tour->pickup_points->per_seat_fare_currency }}
                                @else
                                    PKR
                                @endif
                                @if (isset($tour->pickup_points->per_seat_fare))
                                    {{ $tour->pickup_points->per_seat_fare }}
                                @else
                                    0.00
                                @endif
                            </h1>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>