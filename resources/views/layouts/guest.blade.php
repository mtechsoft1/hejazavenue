{{-- Guest layout: head, header, navbar, content, footer, scripts (professional structure) --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.components.head')
</head>
<body class="antialiased bg-white text-gray-900">
    <div id="app" class="min-h-screen flex flex-col">
        @include('layouts.components.header')

        @unless(View::hasSection('hide_navbar'))
            @include('components.navbar')
        @endunless

        <main class="flex-1 container-fluid px-0">
            @if(session('success'))
                <div id="SessionMessage" class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('error'))
                <div id="SessionMessage" class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </main>

        @unless(View::hasSection('hide_footer'))
            @include('layouts.components.footer')
        @endunless
    </div>

    <script>
        window.axios = (typeof axios !== 'undefined') ? axios : null;
        if (window.axios && document.querySelector('meta[name="csrf-token"]')) {
            window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content;
            window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        }
    </script>
    @stack('scripts')
    @yield('script')
</body>
</html>
