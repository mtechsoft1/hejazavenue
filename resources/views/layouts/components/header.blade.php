{{-- Guest/Front header (optional top bar) --}}
<header class="bg-slate-900/5 border-b border-slate-200/50" role="banner" aria-label="Site header">
    @hasSection('header')
        @yield('header')
    @endif
</header>
