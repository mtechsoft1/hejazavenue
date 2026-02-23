<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { 50: '#ecfdf5', 100: '#d1fae5', 200: '#a7f3d0', 300: '#6ee7b7', 400: '#34d399', 500: '#10b981', 600: '#059669', 700: '#047857', 800: '#065f46', 900: '#064e3b' }
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        #admin-wrapper a,#admin-wrapper button { text-decoration: none; }
        #admin-wrapper a:hover,#admin-wrapper button:hover { text-decoration: none; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased">
    <div id="admin-wrapper" class="flex min-h-screen">
        @include('layouts.admin.sidenav')
        <div id="main-content" class="flex-1 flex flex-col min-w-0 transition-all duration-300 md:ml-64">
            @include('layouts.admin.navbar')
            <main class="flex-1 p-4 md:p-6 lg:p-8">
                @if(session()->has('message'))
                    <div class="mb-4 rounded-lg bg-green-100 border border-green-200 px-4 py-3 text-sm text-green-800">{{ session()->get('message') }}</div>
                @endif
                @if(session()->has('error'))
                    <div class="mb-4 rounded-lg bg-amber-100 border border-amber-200 px-4 py-3 text-sm text-amber-800">{{ session()->get('error') }}</div>
                @endif
                @if(session()->has('success'))
                    <div class="mb-4 rounded-lg bg-green-100 border border-green-200 px-4 py-3 text-sm text-green-800">{{ session()->get('success') }}</div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
