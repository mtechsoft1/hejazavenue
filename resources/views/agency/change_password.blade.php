@extends('agency.layouts.app')
@section('title')
Change Password
@endsection
@section('content')

    
            <div class="row">
                <div class="col-md-12 text-center">
                    @if(session()->has('success'))
                        <div class="alert alert-success text-center">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-warning text-center">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                </div> 
            </div>

        
            <div class="flex items-center justify-center bg-white rounded-lg shadow-md">
                <div class="w-full p-6">
                    <h2 class="text-2xl font-semibold text-center text-gray-700 mb-4">Update Password</h2>
                    <form action="{{ route('agency.update_password') }}" method="post" class="space-y-4">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
            
                        <div>
                            <label for="old_password" class="block text-sm font-medium text-gray-600">Current Password</label>
                            <input type="password" id="old_password" name="old_password" required
                                class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600">
                        </div>
            
                        <div>
                            <label for="new_password" class="block text-sm font-medium text-gray-600">New Password</label>
                            <input type="password" id="new_password" name="new_password" required
                                class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
            
                        <div>
                            <label for="conf_password" class="block text-sm font-medium text-gray-600">Confirm Password</label>
                            <input type="password" id="conf_password" name="conf_password" required
                                class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
            
                        <button type="submit"
                            class="w-full px-4 py-2 text-white bg-[#008000] rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-600">
                            Save
                        </button>
                    </form>
                </div>
            </div>

@endsection

@section('script')

@endsection