@extends('layouts.admin.app')
@section('content')
<div class="mx-auto max-w-7xl">
    <h1 class="text-2xl font-bold text-gray-900 md:text-3xl">Dashboard</h1>
    <p class="mt-1 text-sm text-gray-500">Overview of your admin panel</p>

    {{-- Stat cards (reference style: accent bar, semi-circle, circular icon, hover transitions) --}}
    <div class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
        {{-- Card 1: Blue - Total Users --}}
        <div class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-[0_1px_3px_0_rgba(0,0,0,0.08)] transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-[0_10px_25px_-5px_rgba(0,0,0,0.1),0_8px_10px_-6px_rgba(0,0,0,0.06)]">
            <div class="absolute left-0 top-0 h-1 w-12 rounded-r bg-blue-400"></div>
            <div class="absolute -bottom-10 -right-10 h-32 w-32 rounded-full bg-blue-100/90"></div>
            <div class="relative flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Users</p>
                    <p class="mt-1 text-3xl font-bold text-gray-900">{{ $countuser ?? 0 }}</p>
                </div>
                <div class="flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-full bg-blue-500 text-white shadow-sm transition-transform duration-300 ease-out group-hover:scale-110">
                    <i class="fa fa-users text-xl"></i>
                </div>
            </div>
        </div>
        {{-- Card 2: Purple - Total Providers --}}
        <div class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-[0_1px_3px_0_rgba(0,0,0,0.08)] transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-[0_10px_25px_-5px_rgba(0,0,0,0.1),0_8px_10px_-6px_rgba(0,0,0,0.06)]">
            <div class="absolute left-0 top-0 h-1 w-12 rounded-r bg-purple-400"></div>
            <div class="absolute -bottom-10 -right-10 h-32 w-32 rounded-full bg-purple-100/90"></div>
            <div class="relative flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Providers</p>
                    <p class="mt-1 text-3xl font-bold text-gray-900">{{ $countprovider ?? 0 }}</p>
                </div>
                <div class="flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-full bg-purple-500 text-white shadow-sm transition-transform duration-300 ease-out group-hover:scale-110">
                    <i class="fa fa-briefcase text-xl"></i>
                </div>
            </div>
        </div>
        {{-- Card 3: Green - Maids --}}
        <a href="{{ route('admin.maid.index') }}" class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-[0_1px_3px_0_rgba(0,0,0,0.08)] transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-[0_10px_25px_-5px_rgba(0,0,0,0.1),0_8px_10px_-6px_rgba(0,0,0,0.06)] block no-underline">
            <div class="absolute left-0 top-0 h-1 w-12 rounded-r bg-emerald-400"></div>
            <div class="absolute -bottom-10 -right-10 h-32 w-32 rounded-full bg-emerald-100/90"></div>
            <div class="relative flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Maids</p>
                    <p class="mt-1 text-3xl font-bold text-gray-900">{{ $countmaid ?? 0 }}</p>
                </div>
                <div class="flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-full bg-emerald-500 text-white shadow-sm transition-transform duration-300 ease-out group-hover:scale-110">
                    <i class="fa fa-concierge-bell text-xl"></i>
                </div>
            </div>
        </a>
        {{-- Card 4: Teal - Drivers --}}
        <a href="{{ route('admin.driver.index') }}" class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-[0_1px_3px_0_rgba(0,0,0,0.08)] transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-[0_10px_25px_-5px_rgba(0,0,0,0.1),0_8px_10px_-6px_rgba(0,0,0,0.06)] block no-underline">
            <div class="absolute left-0 top-0 h-1 w-12 rounded-r bg-teal-400"></div>
            <div class="absolute -bottom-10 -right-10 h-32 w-32 rounded-full bg-teal-100/90"></div>
            <div class="relative flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Drivers</p>
                    <p class="mt-1 text-3xl font-bold text-gray-900">{{ $countdriver ?? 0 }}</p>
                </div>
                <div class="flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-full bg-teal-500 text-white shadow-sm transition-transform duration-300 ease-out group-hover:scale-110">
                    <i class="fa fa-id-card text-xl"></i>
                </div>
            </div>
        </a>
    </div>

    {{-- Accommodation bookings stats --}}
    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-3">
        <a href="{{ route('admin.accommodation_bookings.index') }}" class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm hover:border-primary-300 hover:shadow-md transition no-underline block">
            <p class="text-sm font-medium text-gray-500">Total Bookings</p>
            <p class="mt-1 text-xl font-bold text-gray-900">{{ $accommodationBookingsTotal ?? 0 }}</p>
        </a>
        <a href="{{ route('admin.accommodation_bookings.index', ['status' => 'pending']) }}" class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm hover:border-amber-300 hover:shadow-md transition no-underline block">
            <p class="text-sm font-medium text-gray-500">Pending</p>
            <p class="mt-1 text-xl font-bold text-amber-600">{{ $accommodationBookingsPending ?? 0 }}</p>
        </a>
        <a href="{{ route('admin.accommodation_bookings.index', ['status' => 'confirmed']) }}" class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm hover:border-blue-300 hover:shadow-md transition no-underline block">
            <p class="text-sm font-medium text-gray-500">Confirmed</p>
            <p class="mt-1 text-xl font-bold text-blue-600">{{ $accommodationBookingsConfirmed ?? 0 }}</p>
        </a>
    </div>

    {{-- Action cards --}}
        <div class="mt-10">
        <h2 class="text-xl font-semibold text-gray-800">Quick Actions</h2>

        <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-5 auto-rows-fr">

            <!-- Users -->
            <a href="{{ route('admin.users.index') }}"
            class="group flex h-full flex-col justify-between rounded-2xl border border-gray-200 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-primary-300">

                <div>
                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-primary-100 text-primary-600 transition-all duration-300 group-hover:scale-110 group-hover:bg-primary-200">
                        <i class="fa fa-users text-lg"></i>
                    </div>

                    <h3 class="mt-3 text-base font-semibold text-gray-900">
                        Users
                    </h3>

                    <p class="mt-2 text-sm text-gray-500 leading-relaxed">
                        Manage user records and profiles
                    </p>
                </div>

                <div class="mt-2 flex items-center justify-between text-sm font-medium text-primary-600">
                    <span>Manage</span>
                    <i class="fa fa-arrow-right transition-transform duration-300 group-hover:translate-x-1"></i>
                </div>
            </a>

            <!-- Maids -->
            <a href="{{ route('admin.maid.index') }}"
            class="group flex h-full flex-col justify-between rounded-2xl border border-gray-200 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-emerald-300">

                <div>
                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600 transition-all duration-300 group-hover:scale-110 group-hover:bg-emerald-200">
                        <i class="fa fa-concierge-bell text-lg"></i>
                    </div>

                    <h3 class="mt-3 text-base font-semibold text-gray-900">
                        Maids
                    </h3>

                    <p class="mt-2 text-sm text-gray-500 leading-relaxed">
                        View and manage maids
                    </p>
                </div>

                <div class="mt-2 flex items-center justify-between text-sm font-medium text-emerald-600">
                    <span>Manage</span>
                    <i class="fa fa-arrow-right transition-transform duration-300 group-hover:translate-x-1"></i>
                </div>
            </a>

            <!-- Drivers -->
            <a href="{{ route('admin.driver.index') }}"
            class="group flex h-full flex-col justify-between rounded-2xl border border-gray-200 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-teal-300">

                <div>
                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-teal-100 text-teal-600 transition-all duration-300 group-hover:scale-110 group-hover:bg-teal-200">
                        <i class="fa fa-id-card text-lg"></i>
                    </div>

                    <h3 class="mt-3 text-base font-semibold text-gray-900">
                        Drivers
                    </h3>

                    <p class="mt-2 text-sm text-gray-500 leading-relaxed">
                        View and manage drivers
                    </p>
                </div>

                <div class="mt-2 flex items-center justify-between text-sm font-medium text-teal-600">
                    <span>Manage</span>
                    <i class="fa fa-arrow-right transition-transform duration-300 group-hover:translate-x-1"></i>
                </div>
            </a>

            <!-- Accommodation Bookings -->
            <a href="{{ route('admin.accommodation_bookings.index') }}"
            class="group flex h-full flex-col justify-between rounded-2xl border border-gray-200 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-primary-300">

                <div>
                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-primary-100 text-primary-600 transition-all duration-300 group-hover:scale-110 group-hover:bg-primary-200">
                        <i class="fa fa-bed text-lg"></i>
                    </div>

                    <h3 class="mt-3 text-base font-semibold text-gray-900">
                        Bookings
                    </h3>

                    <p class="mt-2 text-sm text-gray-500 leading-relaxed">
                        View and manage accommodation bookings
                    </p>
                </div>

                <div class="mt-2 flex items-center justify-between text-sm font-medium text-primary-600">
                    <span>Manage</span>
                    <i class="fa fa-arrow-right transition-transform duration-300 group-hover:translate-x-1"></i>
                </div>
            </a>

            <!-- Contact Messages -->
            <a href="{{ route('admin.contactus_message') }}"
            class="group flex h-full flex-col justify-between rounded-2xl border border-gray-200 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-amber-300">

                <div>
                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-amber-100 text-amber-600 transition-all duration-300 group-hover:scale-110 group-hover:bg-amber-200">
                        <i class="fa fa-envelope text-lg"></i>
                    </div>

                    <h3 class="mt-3 text-base font-semibold text-gray-900">
                        Contact Messages
                    </h3>

                    <p class="mt-2 text-sm text-gray-500 leading-relaxed">
                        Read and respond to messages
                    </p>
                </div>

                <div class="mt-2 flex items-center justify-between text-sm font-medium text-amber-600">
                    <span>View</span>
                    <i class="fa fa-arrow-right transition-transform duration-300 group-hover:translate-x-1"></i>
                </div>
            </a>

        </div>
    </div>
</div>
@endsection
