{{-- Admin top bar: toggle sidebar, user menu --}}
<header class="admin-header sticky top-0 z-[999] flex items-center justify-between h-14 px-4 bg-white border-b border-gray-200 shadow-sm">
    <button type="button" id="sidebar-toggle" class="p-2 rounded-lg text-gray-600 hover:bg-gray-100 focus:outline-none" aria-label="Toggle sidebar">
        <i class="fa fa-bars text-lg"></i>
    </button>
    <div class="flex items-center gap-4">
        <span class="text-sm text-gray-600 hidden sm:inline">{{ auth()->user()->name ?? 'Admin' }}</span>
        <a href="{{ route('index') }}" class="text-sm text-gray-600 hover:text-gray-900" target="_blank" rel="noopener">View Site</a>
        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="text-sm text-red-600 hover:text-red-700">Logout</button>
        </form>
    </div>
</header>
