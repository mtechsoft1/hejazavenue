@extends('layouts.admin.app')
@section('content')
<div class="mx-auto max-w-7xl">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-2xl font-bold text-gray-900">Drivers</h1>
        <a href="{{ route('admin.driver.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 transition">
            <i class="fa fa-plus"></i> Add Driver
        </a>
    </div>

    @if($drivers->count() > 0)
        <div class="mt-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Photo</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Phone</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nationality</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">License</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Experience</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Languages</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-4 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($drivers as $driver)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3">
                                    @if($driver->image)
                                        <img src="{{ asset('storage/' . $driver->image) }}" alt="{{ $driver->name }}" class="h-10 w-10 rounded-full object-cover">
                                    @else
                                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-gray-200 text-gray-500 text-sm"><i class="fa fa-user"></i></span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $driver->name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $driver->phone }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $driver->nationality ?? '–' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $driver->license_number ?? '–' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $driver->experience_years }} yrs</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $driver->languages_display }}</td>
                                <td class="px-4 py-3">
                                    @if($driver->is_active)
                                        <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full bg-green-100 text-green-800">Active</span>
                                    @else
                                        <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full bg-gray-100 text-gray-600">Inactive</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right space-x-2">
                                    <a href="{{ route('admin.driver.show', $driver->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-primary-600 hover:bg-primary-50 transition" title="View"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('admin.driver.edit', $driver->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-amber-600 hover:bg-amber-50 transition" title="Edit"><i class="fa fa-edit"></i></a>
                                    <form action="{{ route('admin.driver.destroy', $driver->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this driver?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-red-600 hover:bg-red-50 transition" title="Delete"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-3 border-t border-gray-200 bg-gray-50">
                {{ $drivers->links() }}
            </div>
        </div>
    @else
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
            <p class="text-gray-500 mb-4">No drivers yet.</p>
            <a href="{{ route('admin.driver.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700">Add Driver</a>
        </div>
    @endif
</div>
@endsection
