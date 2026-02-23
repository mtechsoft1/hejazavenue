@extends('layouts.admin.app')
@section('content')
<div class="mx-auto max-w-7xl">
    <h1 class="text-2xl font-bold text-gray-900">Contact Us Messages</h1>

    <div class="mt-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        @if($messages->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">ID</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Name</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Email</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Subject</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Message</th>
                            <th scope="col" class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($messages as $message)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="whitespace-nowrap px-4 py-3 text-sm font-medium text-gray-900">{{ $message->id }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-600">{{ $message->name }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-600">{{ $message->email }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $message->subject }}</td>
                                <td class="max-w-xs truncate px-4 py-3 text-sm text-gray-600" title="{{ $message->message }}">{{ $message->message }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-right">
                                    <a href="{{ route('admin.delete_contact_us_message', $message->id) }}" onclick="return confirm('Are you sure you want to delete this message?');" class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-red-600 hover:bg-red-50 transition" title="Delete"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="border-t border-gray-200 bg-gray-50 px-4 py-3">
                {{ $messages->links() }}
            </div>
        @else
            <div class="px-6 py-12 text-center text-gray-500">No messages found.</div>
        @endif
    </div>
</div>
@endsection
