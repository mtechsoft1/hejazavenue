@php
    $current = request()->route() ? request()->route()->getName() : '';
    $isActive = function($names) use ($current) {
        if (is_array($names)) return in_array($current, $names);
        if (str_contains((string) $names, '*')) return request()->routeIs($names);
        return $current === $names;
    };
@endphp
<aside id="sidebar-wrapper" class="fixed top-0 left-0 z-40 h-screen w-64 -translate-x-full border-r border-gray-200 bg-white shadow-sm transition-transform duration-300 ease-out md:translate-x-0">
    <div class="flex h-full flex-col">
        <a href="{{ route('admin.dashboard') }}" class="flex justify-center items-center w-full border-b border-gray-200 px-6 py-4 no-underline hover:no-underline">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-9 w-auto max-w-[140px] object-contain block" onerror="this.onerror=null; this.style.display='none'; var c=this.nextElementSibling; if(c) c.classList.remove('hidden');" />
            <span class="hidden h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-primary-600 text-white text-sm font-bold">C</span>
        </a>
        <nav class="flex-1 overflow-y-auto py-4">
            <ul class="space-y-0.5 px-3">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors no-underline hover:no-underline {{ $isActive('admin.dashboard') ? 'border-l-4 border-primary-600 bg-primary-50 text-primary-700 pl-[11px]' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                        <i class="fa fa-home w-5 text-center text-gray-500"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <details class="group" {{ $isActive(['admin.users.index','admin.provider']) ? 'open' : '' }}>
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900 [&::-webkit-details-marker]:hidden">
                            <span class="flex items-center gap-3">
                                <i class="fa fa-users w-5 text-center text-gray-500"></i>
                                <span>Manage Users</span>
                            </span>
                            <i class="fa fa-chevron-down text-xs text-gray-400 transition-transform group-open:rotate-180"></i>
                        </summary>
                        <div class="mt-0.5 space-y-0.5 pl-8">
                            <a href="{{ route('admin.users.index') }}" class="block rounded-lg px-3 py-2 text-sm no-underline hover:no-underline {{ $isActive('admin.users.index') ? 'bg-primary-50 font-medium text-primary-700' : 'text-gray-600 hover:bg-gray-100' }}">Users</a>
                            <a href="{{ route('admin.provider') }}" class="block rounded-lg px-3 py-2 text-sm no-underline hover:no-underline {{ $isActive('admin.provider') ? 'bg-primary-50 font-medium text-primary-700' : 'text-gray-600 hover:bg-gray-100' }}">Providers</a>
                        </div>
                    </details>
                </li>
                <li>
                    <a href="{{ route('admin.destination.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors no-underline hover:no-underline {{ $isActive('admin.destination.*') ? 'border-l-4 border-primary-600 bg-primary-50 text-primary-700 pl-[11px]' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                        <i class="fa fa-list w-5 text-center text-gray-500"></i>
                        <span>Destinations</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="{{ route('admin.tours.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors no-underline hover:no-underline {{ $isActive('admin.tours.*') ? 'border-l-4 border-primary-600 bg-primary-50 text-primary-700 pl-[11px]' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                        <i class="fa fa-list w-5 text-center text-gray-500"></i>
                        <span>Tours</span>
                    </a>
                </li> -->
                <li>
                    <a href="{{ route('admin.bookings.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors no-underline hover:no-underline {{ $isActive('admin.bookings.*') ? 'border-l-4 border-primary-600 bg-primary-50 text-primary-700 pl-[11px]' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                        <i class="fa fa-list w-5 text-center text-gray-500"></i>
                        <span>Bookings</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.chauffeur_service.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors no-underline hover:no-underline {{ $isActive('admin.chauffeur_service.*') ? 'border-l-4 border-primary-600 bg-primary-50 text-primary-700 pl-[11px]' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                        <i class="fa fa-car w-5 text-center text-gray-500"></i>
                        <span>Chauffeur Services</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.accommodation.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors no-underline hover:no-underline {{ $isActive('admin.accommodation.*') ? 'border-l-4 border-primary-600 bg-primary-50 text-primary-700 pl-[11px]' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                        <i class="fa fa-home w-5 text-center text-gray-500"></i>
                        <span>Properties</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.maid.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors no-underline hover:no-underline {{ $isActive('admin.maid.*') ? 'border-l-4 border-primary-600 bg-primary-50 text-primary-700 pl-[11px]' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                        <i class="fa fa-user-circle w-5 text-center text-gray-500"></i>
                        <span>Maids</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.driver.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors no-underline hover:no-underline {{ $isActive('admin.driver.*') ? 'border-l-4 border-primary-600 bg-primary-50 text-primary-700 pl-[11px]' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                        <i class="fa fa-car w-5 text-center text-gray-500"></i>
                        <span>Drivers</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.user_reviews') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors no-underline hover:no-underline {{ $isActive('admin.user_reviews') ? 'border-l-4 border-primary-600 bg-primary-50 text-primary-700 pl-[11px]' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                        <i class="fa fa-star w-5 text-center text-gray-500"></i>
                        <span>User Reviews</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.contactus_message') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors no-underline hover:no-underline {{ $isActive('admin.contactus_message') ? 'border-l-4 border-primary-600 bg-primary-50 text-primary-700 pl-[11px]' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                        <i class="fa fa-envelope w-5 text-center text-gray-500"></i>
                        <span>Contact Messages</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
{{-- Sidebar overlay on mobile when open --}}
<div id="sidebar-overlay" class="fixed inset-0 z-30 bg-black/20 opacity-0 pointer-events-none transition-opacity md:hidden" aria-hidden="true"></div>
<script>
    (function() {
        var wrapper = document.getElementById('admin-wrapper');
        var sidebar = document.getElementById('sidebar-wrapper');
        var overlay = document.getElementById('sidebar-overlay');
        var bar = document.getElementById('bar');
        function toggle() {
            wrapper.classList.toggle('sidebar-open');
            if (overlay) {
                overlay.classList.toggle('opacity-0');
                overlay.classList.toggle('pointer-events-none');
            }
            if (sidebar) sidebar.classList.toggle('translate-x-0');
            if (sidebar) sidebar.classList.toggle('-translate-x-full');
        }
        if (bar) bar.addEventListener('click', toggle);
        if (overlay) overlay.addEventListener('click', toggle);
        document.addEventListener('DOMContentLoaded', function() {
            if (wrapper && wrapper.classList.contains('sidebar-open')) {
                if (sidebar) { sidebar.classList.add('translate-x-0'); sidebar.classList.remove('-translate-x-full'); }
                if (overlay) { overlay.classList.remove('opacity-0', 'pointer-events-none'); }
            }
        });
    })();
</script>
