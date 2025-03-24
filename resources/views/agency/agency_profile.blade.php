@extends('agency.layouts.app')
@section('title')
    Account Details
@endsection
@section('content')


    <div class="row">
        <div class="col-md-12 text-center">
            @if (session()->has('success'))
                <div class="alert alert-success text-center">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-warning text-center">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div>
    </div>


    <div class="mx-auto bg-white md:p-6 p-3 rounded-lg shadow-lg">
        <div class="flex justify-center mb-4">
            <img src="{{ Auth::user()->profile_image }}" class="w-24 h-24 rounded-full object-cover ring-4 ring-[#008000]" />
        </div>
        <form action="{{ route('agency.update_profile') }}" method="post" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
    
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600">Name</label>
                    <input type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="name" name="name" value="{{ Auth::user()->name }}" required />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Company Name</label>
                    <input type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="company_name" name="company_name" value="{{ Auth::user()->company_name }}" required />
                </div>
            </div>
    
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600">Phone Number</label>
                    <input type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="phone" name="phone" value="{{ Auth::user()->phone }}" required />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Email Address</label>
                    <input type="email" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="email" name="email" value="{{ Auth::user()->email }}" required />
                </div>
            </div>
    
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600">License Number (Optional)</label>
                    <input type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="license_number" name="license_number" value="{{ Auth::user()->license_number }}" />
                </div> 
                <div>
                    <label class="block text-sm font-medium text-gray-600">Street Address</label>
                    <input type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="address" name="address" value="{{ Auth::user()->address }}" required />
                </div>
            </div>
    
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600">City</label>
                    <input type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="city" name="city" value="{{ Auth::user()->city }}" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">State</label>
                    <input type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="state" name="state" value="{{ Auth::user()->state }}" required />
                </div>
            </div>
    
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600">Country</label>
                    <input type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="country" name="country" value="{{ Auth::user()->country }}" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Postal Code</label>
                    <input type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="zip" name="zip" value="{{ Auth::user()->zip }}" required />
                </div>
            </div>
    
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600">Account Title</label>
                    <input type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="account_title" name="account_title" value="{{ Auth::user()->account_title }}" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Account Number</label>
                    <input type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="account_number" name="account_number" value="{{ Auth::user()->account_number }}" required />
                </div>
            </div>
    
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600">Bank Name</label>
                    <input type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="bank_name" name="bank_name" value="{{ Auth::user()->bank_name }}" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Profile Image</label>
                    <input type="file" class="w-full px-3 py-2 border border-gray-300 rounded-lg " id="profile_image" name="profile_image" />
                </div>
            </div>
    
            <div>
                <label class="block text-sm font-medium text-gray-600">Banner Images</label>
                <input type="file" class="w-full px-3 py-2 border border-gray-300 rounded-lg" id="banner_image" name="banner_image" />
            </div>
    
            <div>
                <label class="block text-sm font-medium text-gray-600 ">Company Description</label>
                <textarea class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="company_description" name="company_description" rows="3">{{ Auth::user()->company_description }}</textarea>
            </div>
    
            <div class="flex justify-center">
                <input type="submit" value="Save" class="w-full bg-[#008000] text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-all cursor-pointer shadow-lg" />
            </div>
        </form>
    </div>



@endsection

@section('script')
@endsection
