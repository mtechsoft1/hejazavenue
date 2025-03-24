@extends('user.layouts.app')
@section('title')
Change Password
@endsection
@section('content')
        
        <div class="w-full bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-700 text-center mb-4">Change Password</h2>
            <form action="{{ route('user.update_password') }}" method="post" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                
                <div>
                    <label for="old_password" class="block text-sm font-medium text-gray-600">Current Password</label>
                    <input 
                        type="password" 
                        id="old_password" 
                        name="old_password" 
                        required 
                        class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600"
                    />
                </div>
                
                <div>
                    <label for="new_password" class="block text-sm font-medium text-gray-600">New Password</label>
                    <input 
                        type="password" 
                        id="new_password" 
                        name="new_password" 
                        required 
                        class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600"
                    />
                </div>
                
                <div>
                    <label for="conf_password" class="block text-sm font-medium text-gray-600">Confirm Password</label>
                    <input 
                        type="password" 
                        id="conf_password" 
                        name="conf_password" 
                        required 
                        class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600"
                    />
                </div>
                
                <button 
                    type="submit" 
                    class="w-full bg-[#008000] text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-all cursor-pointer shadow-lg">
                    Save
                </button>
            </form>
        </div>

@endsection

@section('script')

@endsection