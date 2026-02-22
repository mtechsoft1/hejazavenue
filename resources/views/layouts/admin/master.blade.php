{{-- Admin master layout: sidebar, header, content, footer (professional structure) --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Admin') - {{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('img/fav_icon.png') }}" />
    @if(file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <style>
        #sidebar-wrapper.toggled { width: 270px; left: 0; }
        #wrapper.toggled #page-content-wrapper { margin-left: 270px; }
        #page-content-wrapper { margin-left: 0; transition: margin-left .3s ease; }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    @stack('styles')
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <div id="wrapper" class="flex min-h-screen">
        @include('layouts.components.admin.sidebar')

        <div id="page-content-wrapper" class="flex-1 flex flex-col min-w-0 transition-all duration-300">
            @include('layouts.components.admin.header')

            <main class="flex-1 p-4 md:p-6">
                @if(session('success'))
                    <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-800 text-sm">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-800 text-sm">{{ session('error') }}</div>
                @endif
                @yield('content')
            </main>

            @include('layouts.components.admin.footer')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        document.getElementById('sidebar-toggle')?.addEventListener('click', function() {
            document.getElementById('wrapper').classList.toggle('toggled');
            document.getElementById('sidebar-wrapper').classList.toggle('toggled');
        });
    </script>
    @stack('scripts')
    @yield('script')
</body>
</html>
