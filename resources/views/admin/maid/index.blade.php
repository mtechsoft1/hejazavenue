@extends('layouts.admin.app')
@section('content')
<div class="mx-auto max-w-7xl">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-2xl font-bold text-gray-900">Maids</h1>
        <a href="{{ route('admin.maid.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 transition">
            <i class="fa fa-plus"></i> Add Maid
        </a>
    </div>

    @if($maids->count() > 0)
        <div class="mt-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Photo</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Phone</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nationality</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Experience</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-4 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($maids as $maid)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3">
                                    @if($maid->image)
                                        <img src="{{ asset('storage/' . $maid->image) }}" alt="{{ $maid->name }}" class="h-10 w-10 rounded-full object-cover">
                                    @else
                                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-gray-200 text-gray-500 text-sm"><i class="fa fa-user"></i></span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $maid->name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $maid->phone }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $maid->email ?? '–' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $maid->nationality ?? '–' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $maid->experience_years }} yrs</td>
                                <td class="px-4 py-3">
                                    @if($maid->is_active)
                                        <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full bg-green-100 text-green-800">Active</span>
                                    @else
                                        <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full bg-gray-100 text-gray-600">Inactive</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right space-x-2">
                                    <a href="{{ route('admin.maid.show', $maid->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-primary-600 hover:bg-primary-50 transition" title="View"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('admin.maid.edit', $maid->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-amber-600 hover:bg-amber-50 transition" title="Edit"><i class="fa fa-edit"></i></a>
                                    <form action="{{ route('admin.maid.destroy', $maid->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this maid?');">
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
                {{ $maids->links() }}
            </div>
        </div>
    @else
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
            <p class="text-gray-500 mb-4">No maids yet.</p>
            <a href="{{ route('admin.maid.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700">Add Maid</a>
        </div>
    @endif
</div>
@endsection
