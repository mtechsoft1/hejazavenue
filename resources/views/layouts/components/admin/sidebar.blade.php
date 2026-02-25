{{-- Admin sidebar navigation --}}
<nav id="sidebar-wrapper" class="fixed top-0 left-0 z-[1000] h-full w-0 overflow-y-auto overflow-x-hidden bg-[#222e3c] transition-all duration-300 overflow-y-auto overflow-x-hidden bg-[#222e3c] transition-all duration-300 ease-out" role="navigation" aria-label="Admin sidebar">
    <div class="py-4">
        <a class="sidebar-brand block px-6 py-4 text-base font-semibold text-slate-100 hover:text-white" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <ul class="navbar-nav mt-2 space-y-0.5">
            <li class="has-sub">
                <a class="nav-link flex items-center gap-2 px-6 py-3 text-sm text-slate-300 hover:bg-white/10 hover:text-white transition" href="#collapseUsers" data-toggle="collapse" aria-expanded="false">
                    <i class="fa fa-users w-4"></i>
                    <span>Manage Users</span>
                    <i class="fa fa-chevron-down ml-auto text-xs"></i>
                </a>
                <div class="collapse" id="collapseUsers">
                    <ul class="list-unstyled pl-8 py-2 space-y-0.5">
                        <li><a href="{{ route('admin.users.index') }}" class="block py-2 px-2 text-sm text-slate-400 hover:text-white"><i class="fa fa-user mr-2"></i>Users</a></li>
                        <li><a href="{{ route('admin.provider') }}" class="block py-2 px-2 text-sm text-slate-400 hover:text-white"><i class="fa fa-user mr-2"></i>Providers</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="{{ route('admin.destination.index') }}" class="nav-link flex items-center gap-2 px-6 py-3 text-sm text-slate-300 hover:bg-white/10 hover:text-white"><i class="fa fa-list w-4"></i>Destinations</a></li>
            <li><a href="{{ route('admin.tours.index') }}" class="nav-link flex items-center gap-2 px-6 py-3 text-sm text-slate-300 hover:bg-white/10 hover:text-white"><i class="fa fa-list w-4"></i>Tours</a></li>
            <li><a href="{{ route('admin.bookings.index') }}" class="nav-link flex items-center gap-2 px-6 py-3 text-sm text-slate-300 hover:bg-white/10 hover:text-white"><i class="fa fa-list w-4"></i>Bookings</a></li>
            <li><a href="{{ route('admin.chauffeur_service.index') }}" class="nav-link flex items-center gap-2 px-6 py-3 text-sm text-slate-300 hover:bg-white/10 hover:text-white"><i class="fa fa-car w-4"></i>Chauffeur Services</a></li>
            <li><a href="{{ route('admin.accommodation.index') }}" class="nav-link flex items-center gap-2 px-6 py-3 text-sm text-slate-300 hover:bg-white/10 hover:text-white"><i class="fa fa-home w-4"></i>Accommodations</a></li>
            <li><a href="{{ route('admin.maid.index') }}" class="nav-link flex items-center gap-2 px-6 py-3 text-sm text-slate-300 hover:bg-white/10 hover:text-white"><i class="fa fa-user-circle w-4"></i>Maids</a></li>
            <li><a href="{{ route('admin.driver.index') }}" class="nav-link flex items-center gap-2 px-6 py-3 text-sm text-slate-300 hover:bg-white/10 hover:text-white"><i class="fa fa-car w-4"></i>Drivers</a></li>
            <li><a href="{{ route('admin.user_reviews') }}" class="nav-link flex items-center gap-2 px-6 py-3 text-sm text-slate-300 hover:bg-white/10 hover:text-white"><i class="fa fa-star w-4"></i>User Reviews</a></li>
            <li><a href="{{ route('admin.contactus_message') }}" class="nav-link flex items-center gap-2 px-6 py-3 text-sm text-slate-300 hover:bg-white/10 hover:text-white"><i class="fa fa-envelope w-4"></i>Contact Messages</a></li>
        </ul>
    </div>
</nav>
