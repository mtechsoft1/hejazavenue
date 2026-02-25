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

    {{-- Secondary stat row --}}
    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-3">
        <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
            <p class="text-sm font-medium text-gray-500">Total Bookings</p>
            <p class="mt-1 text-xl font-bold text-gray-900">{{ $countbookings ?? 0 }}</p>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
            <p class="text-sm font-medium text-gray-500">Total Reviews</p>
            <p class="mt-1 text-xl font-bold text-gray-900">{{ $countreviews ?? 0 }}</p>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
            <p class="text-sm font-medium text-gray-500">Contact Messages</p>
            <p class="mt-1 text-xl font-bold text-gray-900">{{ $countmessages ?? 0 }}</p>
        </div>
    </div>

    {{-- Action cards --}}
    <div class="mt-10">
        <h2 class="text-lg font-semibold text-gray-900">Quick actions</h2>
        <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-5">
            <a href="{{ route('admin.users.index') }}" class="group flex flex-col rounded-2xl border border-gray-200 bg-white p-5 shadow-[0_1px_3px_0_rgba(0,0,0,0.08)] transition-all duration-300 ease-out no-underline hover:no-underline hover:-translate-y-1 hover:shadow-[0_10px_25px_-5px_rgba(0,0,0,0.1),0_8px_10px_-6px_rgba(0,0,0,0.06)]">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary-100 text-primary-600 transition-transform duration-300 ease-out group-hover:scale-110 group-hover:bg-primary-200">
                    <i class="fa fa-users text-xl"></i>
                </div>
                <h3 class="mt-4 font-semibold text-gray-900">Users</h3>
                <p class="mt-1 text-sm text-gray-500">Manage user records and profiles</p>
            </a>
            <a href="{{ route('admin.maid.index') }}" class="group flex flex-col rounded-2xl border border-gray-200 bg-white p-5 shadow-[0_1px_3px_0_rgba(0,0,0,0.08)] transition-all duration-300 ease-out no-underline hover:no-underline hover:-translate-y-1 hover:shadow-[0_10px_25px_-5px_rgba(0,0,0,0.1),0_8px_10px_-6px_rgba(0,0,0,0.06)]">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600 transition-transform duration-300 ease-out group-hover:scale-110 group-hover:bg-emerald-200">
                    <i class="fa fa-concierge-bell text-xl"></i>
                </div>
                <h3 class="mt-4 font-semibold text-gray-900">Maids</h3>
                <p class="mt-1 text-sm text-gray-500">View and manage maids</p>
            </a>
            <a href="{{ route('admin.driver.index') }}" class="group flex flex-col rounded-2xl border border-gray-200 bg-white p-5 shadow-[0_1px_3px_0_rgba(0,0,0,0.08)] transition-all duration-300 ease-out no-underline hover:no-underline hover:-translate-y-1 hover:shadow-[0_10px_25px_-5px_rgba(0,0,0,0.1),0_8px_10px_-6px_rgba(0,0,0,0.06)]">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-teal-100 text-teal-600 transition-transform duration-300 ease-out group-hover:scale-110 group-hover:bg-teal-200">
                    <i class="fa fa-id-card text-xl"></i>
                </div>
                <h3 class="mt-4 font-semibold text-gray-900">Drivers</h3>
                <p class="mt-1 text-sm text-gray-500">View and manage drivers</p>
            </a>
            <a href="{{ route('admin.bookings.index') }}" class="group flex flex-col rounded-2xl border border-gray-200 bg-white p-5 shadow-[0_1px_3px_0_rgba(0,0,0,0.08)] transition-all duration-300 ease-out no-underline hover:no-underline hover:-translate-y-1 hover:shadow-[0_10px_25px_-5px_rgba(0,0,0,0.1),0_8px_10px_-6px_rgba(0,0,0,0.06)]">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-blue-600 transition-transform duration-300 ease-out group-hover:scale-110 group-hover:bg-blue-200">
                    <i class="fa fa-calendar-check text-xl"></i>
                </div>
                <h3 class="mt-4 font-semibold text-gray-900">Bookings</h3>
                <p class="mt-1 text-sm text-gray-500">View and manage bookings</p>
            </a>
            <a href="{{ route('admin.contactus_message') }}" class="group flex flex-col rounded-2xl border border-gray-200 bg-white p-5 shadow-[0_1px_3px_0_rgba(0,0,0,0.08)] transition-all duration-300 ease-out no-underline hover:no-underline hover:-translate-y-1 hover:shadow-[0_10px_25px_-5px_rgba(0,0,0,0.1),0_8px_10px_-6px_rgba(0,0,0,0.06)]">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-100 text-amber-600 transition-transform duration-300 ease-out group-hover:scale-110 group-hover:bg-amber-200">
                    <i class="fa fa-envelope text-xl"></i>
                </div>
                <h3 class="mt-4 font-semibold text-gray-900">Contact Messages</h3>
                <p class="mt-1 text-sm text-gray-500">Read and respond to messages</p>
            </a>
        </div>
    </div>
</div>
@endsection
