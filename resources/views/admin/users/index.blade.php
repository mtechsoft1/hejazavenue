@extends('layouts.admin.app')
@section('content')
<div class="mx-auto max-w-7xl">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Users</h1>
    </div>

    <div class="mt-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        @if($users->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Name</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Email</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Phone</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Profile</th>
                            <th scope="col" class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="whitespace-nowrap px-4 py-3 text-sm font-medium text-gray-900">{{ $user->name }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-600">{{ $user->email }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-600">{{ $user->phone ?? '–' }}</td>
                                <td class="whitespace-nowrap px-4 py-3">
                                    @if($user->profile_image)
                                        <img src="{{ asset($user->profile_image) }}" alt="" class="h-10 w-10 rounded-lg object-cover border border-gray-200">
                                    @else
                                        <span class="text-gray-400 text-sm">–</span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-right">
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-primary-600 hover:bg-primary-50 transition" title="View"><i class="fa fa-eye"></i></a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline ml-1" onsubmit="return confirm('Are you sure you want to delete this user?');">
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
                {{ $users->links() }}
            </div>
        @else
            <div class="px-6 py-12 text-center text-gray-500">No users found.</div>
        @endif
    </div>
</div>
@endsection
