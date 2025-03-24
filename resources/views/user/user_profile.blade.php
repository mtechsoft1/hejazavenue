@extends('user.layouts.app')
@section('title')
Account Details
@endsection
@section('content')

    <div class="mx-auto bg-white md:p-6 p-3 rounded-lg shadow-lg">
        <div id="avatar-div" class="text-center mb-6">
            <img src="{{ Auth::user()->profile_image }}" class="main-profile-img w-24 h-24 rounded-full mx-auto object-cover" />
        </div>
       
        <form class="mt-4" action="{{ route('user.update_profile') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
        
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="form-group">
                    <label for="name" class="block text-sm font-medium text-gray-600">Name</label>
                    <input type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="name" name="name" value="{{ Auth::user()->name }}" required />
                </div>
                
                <div class="form-group">
                    <label for="phone" class="block text-sm font-medium text-gray-600">Phone Number</label>
                    <input type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="phone" name="phone" value="{{ Auth::user()->phone }}" required />
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                <div class="form-group">
                    <label for="email" class="block text-sm font-medium text-gray-600">Email Address</label>
                    <input type="email" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="email" name="email" value="{{ Auth::user()->email }}" required />
                </div>
                
                <div class="form-group">
                    <label for="profile_image" class="block text-sm font-medium text-gray-600">Profile Image</label>
                    <input type="file" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="file" name="profile_image" required />
                </div>
            </div>
    
            <div class="row justify-center mt-6">
                <input type="submit" value="Save" class="w-full bg-[#008000] text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-all cursor-pointer shadow-lg" />
            </div>
        </form>
    </div>


@endsection

@section('script')

@endsection