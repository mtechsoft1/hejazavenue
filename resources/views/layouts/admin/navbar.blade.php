<header class="sticky top-0 z-20 flex items-center justify-between border-b border-gray-200 bg-white px-4 py-3 shadow-sm md:px-6">
    <div class="flex items-center gap-4">
        <button type="button" id="bar" class="flex h-10 w-10 items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 md:hidden" aria-label="Toggle sidebar">
            <i class="fa fa-bars text-lg"></i>
        </button>
        <a href="{{ route('admin.dashboard') }}" class="hidden text-lg font-semibold text-gray-900 md:inline">Dashboard</a>
    </div>
    <div class="relative flex items-center gap-2">
        <details class="group relative">
            <summary class="admin-user-summary flex cursor-pointer list-none items-center gap-3 rounded-lg border-2 border-transparent px-3 py-2 transition-colors duration-200 [&::-webkit-details-marker]:hidden group-open:border-primary-500 group-open:bg-primary-50/50">
                <span class="flex h-9 w-9 items-center justify-center rounded-full bg-primary-600 text-sm font-semibold text-white">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </span>
                <span class="hidden text-left text-sm md:block">
                    <span class="block font-medium text-gray-900">{{ Auth::user()->name ?? 'Admin User' }}</span>
                    <span class="block text-xs text-gray-500">Administrator</span>
                </span>
                <i class="fa fa-chevron-down text-xs text-gray-400 transition-transform group-open:rotate-180"></i>
            </summary>
            <div class="absolute right-0 top-full z-50 mt-1 w-56 rounded-lg border border-gray-200 bg-white py-1 shadow-lg">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                    <i class="fa fa-home w-4 text-gray-400"></i>
                    Dashboard
                </a>
                <div class="my-1 border-t border-gray-100"></div>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                    <i class="fa fa-sign-out-alt w-4"></i>
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </details>
    </div>
    <style>
        .admin-user-summary { background-color: transparent; }
        .admin-user-summary:hover { background-color: rgb(240 253 244); } /* green-50 */
    </style>
</header>
