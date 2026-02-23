@extends('layouts.admin.app')
@section('content')
<div class="mx-auto max-w-3xl">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <h1 class="text-2xl font-bold text-gray-900">Destination</h1>
        <div class="flex gap-2">
            <a href="{{ route('admin.destination.index') }}" class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">Back</a>
            <a href="{{ route('admin.destination.edit', $destinations->id) }}" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700 transition">Edit</a>
        </div>
    </div>
    <div class="mt-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200">
            <tbody class="divide-y divide-gray-200 bg-white">
                <tr><td class="px-4 py-3 text-sm font-medium text-gray-500 w-40">Destination Name</td><td class="px-4 py-3 text-sm text-gray-900">{{ $destinations->destination_name }}</td></tr>
                <tr><td class="px-4 py-3 text-sm font-medium text-gray-500">Image</td><td class="px-4 py-3"><img src="{{ asset($destinations->destination_image) }}" alt="" class="h-20 rounded-lg border border-gray-200 object-cover"></td></tr>
                <tr><td class="px-4 py-3 text-sm font-medium text-gray-500">Is Public</td><td class="px-4 py-3 text-sm text-gray-900">{{ $destinations->is_public }}</td></tr>
                <tr><td class="px-4 py-3 text-sm font-medium text-gray-500">Created At</td><td class="px-4 py-3 text-sm text-gray-600">{{ $destinations->created_at }}</td></tr>
                <tr><td class="px-4 py-3 text-sm font-medium text-gray-500">Updated At</td><td class="px-4 py-3 text-sm text-gray-600">{{ $destinations->updated_at }}</td></tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
