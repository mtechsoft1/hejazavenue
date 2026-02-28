{{-- Navbar: Tailwind only, no custom CSS. Properties dropdown = group-hover. --}}
<nav id="main-navbar"
     class="group fixed top-0 left-0 right-0 z-[100] transition-all duration-300 overflow-visible bg-slate-900/90 backdrop-blur-md data-[scrolled=true]:bg-white data-[scrolled=true]:shadow-md"
     x-data="{ mobPropOpen: false }">
    <div class="lg:max-w-[1400px] mx-auto w-full px-4 sm:px-6 py-3 flex items-center justify-between">
        <a href="{{ route('index') }}" class="flex-shrink-0">
            <img class="h-12 w-auto max-w-[140px] object-contain" src="{{ asset('./img/logo.png') }}" alt="Logo" />
        </a>

        {{-- Desktop nav --}}
        <div class="hidden lg:flex items-center gap-1">
            <a href="{{ route('index') }}"
               class="nav-link text-white/95 hover:text-green-400 group-data-[scrolled=true]:text-slate-700 group-data-[scrolled=true]:hover:text-green-600 group-data-[scrolled=true]:hover:bg-gray-100 text-sm font-semibold px-4 py-2 rounded-lg hover:bg-white/10 transition-colors no-underline flex items-center gap-1.5">
                <i class="fa fa-home opacity-90"></i> Home
            </a>

            {{-- Properties: hover to show dropdown (works on all pages including home) --}}
            <div id="props-dropdown-wrap" class="relative">
                <span id="props-trigger" class="nav-link text-white/95 hover:text-green-400 group-data-[scrolled=true]:text-slate-700 group-data-[scrolled=true]:hover:text-green-600 group-data-[scrolled=true]:hover:bg-gray-100 text-sm font-semibold px-4 py-2 rounded-lg hover:bg-white/10 transition-colors cursor-default flex items-center gap-1.5">
                    <i class="fa fa-building opacity-90"></i>
                    Properties
                    <i id="props-chevron" class="fa fa-chevron-down text-[10px] transition-transform duration-200"></i>
                </span>
                <div id="props-menu" class="absolute left-0 top-full pt-1 w-52 z-[9999] transition-opacity duration-150" role="menu" style="opacity:0;visibility:hidden;pointer-events:none;">
                    <div class="bg-white rounded-xl shadow-xl border border-gray-200 py-2">
                        <a href="{{ route('index') }}#apartments"
                           class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-slate-800 hover:bg-green-50 hover:text-green-700 no-underline">
                            <i class="fa fa-building w-4 text-green-600"></i>
                            Apartment
                        </a>
                        <a href="{{ route('index') }}#villas"
                           class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-slate-800 hover:bg-green-50 hover:text-green-700 no-underline">
                            <i class="fa fa-flag w-4 text-green-600"></i>
                            Villa
                        </a>
                    </div>
                </div>
            </div>

            <a href="{{ route('contact') }}"
            <a href="{{ route('contact') }}"
               class="nav-link text-white/95 hover:text-green-400 group-data-[scrolled=true]:text-slate-700 group-data-[scrolled=true]:hover:text-green-600 group-data-[scrolled=true]:hover:bg-gray-100 text-sm font-semibold px-4 py-2 rounded-lg hover:bg-white/10 transition-colors no-underline">Maps</a>
            <a href="{{ route('about_us') }}"
               class="nav-link text-white/95 hover:text-green-400 group-data-[scrolled=true]:text-slate-700 group-data-[scrolled=true]:hover:text-green-600 group-data-[scrolled=true]:hover:bg-gray-100 text-sm font-semibold px-4 py-2 rounded-lg hover:bg-white/10 transition-colors no-underline">About Us</a>
            <a href="{{ route('contact') }}"
               class="nav-link text-white/95 hover:text-green-400 group-data-[scrolled=true]:text-slate-700 group-data-[scrolled=true]:hover:text-green-600 group-data-[scrolled=true]:hover:bg-gray-100 text-sm font-semibold px-4 py-2 rounded-lg hover:bg-white/10 transition-colors no-underline">Contact Us</a>

            <div class="nav-border ml-6 pl-6 border-l border-white/20 group-data-[scrolled=true]:border-gray-200 flex items-center gap-4">
                @auth
                    <a href="{{ route('home') }}" class="nav-link text-white/95 hover:text-green-400 group-data-[scrolled=true]:text-slate-700 group-data-[scrolled=true]:hover:text-green-600 text-sm font-semibold no-underline">My Account</a>
                    <a href="{{ route('logout') }}" class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold py-2.5 px-6 rounded-full no-underline">Logout</a>
                @else
                    <a href="{{ route('login') }}" class="nav-link text-white/95 hover:text-green-400 group-data-[scrolled=true]:text-slate-700 group-data-[scrolled=true]:hover:text-green-600 text-sm font-semibold no-underline">Sign In</a>
                    <a href="{{ route('register') }}#register-form" class="register-btn bg-white hover:bg-gray-100 text-slate-900 group-data-[scrolled=true]:!bg-green-600 group-data-[scrolled=true]:!text-white group-data-[scrolled=true]:hover:!bg-green-700 text-sm font-semibold py-2.5 px-6 rounded-full shadow no-underline">Register</a>
                @endauth
            </div>
        </div>

        {{-- Mobile menu toggle --}}
        <button type="button"
                onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
                class="lg:hidden p-2 rounded-lg text-white/95 hover:bg-white/10 border-0 bg-transparent">
            <i class="fa fa-bars text-xl"></i>
        </button>
    </div>

    {{-- Mobile menu --}}
    <div id="mobile-menu" class="hidden lg:hidden border-t border-white/10">
        <div class="px-4 py-4 flex flex-col gap-1">
            <a href="{{ route('index') }}" class="text-white/95 py-3 text-base font-semibold no-underline">Home</a>
            <div>
                <button type="button" @click="mobPropOpen = !mobPropOpen"
                        class="text-white/95 w-full flex items-center justify-between py-3 text-base font-semibold text-left border-0 bg-transparent">
                    <span>Properties</span>
                    <i class="fa fa-chevron-down transition-transform" :class="mobPropOpen ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="mobPropOpen" x-transition class="pl-4 flex flex-col gap-1 border-l-2 border-white/20">
                    <a href="{{ route('index') }}#apartments" class="text-white/95 py-2 text-sm no-underline">Apartment</a>
                    <a href="{{ route('index') }}#villas" class="text-white/95 py-2 text-sm no-underline">Villa</a>
                </div>
            </div>
            <a href="{{ route('contact') }}" class="text-white/95 py-3 text-base font-semibold no-underline">Apartments</a>
            <a href="{{ route('contact') }}" class="text-white/95 py-3 text-base font-semibold no-underline">Maps</a>
            <a href="{{ route('about_us') }}" class="text-white/95 py-3 text-base font-semibold no-underline">About Us</a>
            <a href="{{ route('contact') }}" class="text-white/95 py-3 text-base font-semibold no-underline">Contact Us</a>
            <div class="pt-4 mt-2 border-t border-white/10 flex flex-col gap-2">
                @auth
                    <a href="{{ route('home') }}" class="text-white/95 py-3 text-base font-semibold no-underline">My Account</a>
                    <a href="{{ route('logout') }}" class="bg-red-600 text-white text-center py-3 rounded-full font-semibold no-underline">Logout</a>
                @else
                    <a href="{{ route('login') }}" class="text-white/95 py-3 text-base font-semibold no-underline">Sign In</a>
                    <a href="{{ route('register') }}#register-form" class="bg-white text-slate-900 text-center py-3 rounded-full font-semibold no-underline">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

{{-- Spacer --}}
<div class="h-16 lg:h-[4.5rem]"></div>

{{-- Scroll + Properties: HOVER to show dropdown (all pages + home) --}}
<script>
(function() {
    var nav = document.getElementById('main-navbar');
    if (nav) {
        function updateScroll() {
            nav.setAttribute('data-scrolled', window.scrollY > 20 ? 'true' : 'false');
        }
        window.addEventListener('scroll', updateScroll, { passive: true });
        updateScroll();
    }

    function bindPropsHover() {
        var wrap = document.getElementById('props-dropdown-wrap');
        var menu = document.getElementById('props-menu');
        var chevron = document.getElementById('props-chevron');
        if (!wrap || !menu) return;
        if (wrap._propsBound) return;
        wrap._propsBound = true;

        function show() {
            menu.style.opacity = '1';
            menu.style.visibility = 'visible';
            menu.style.pointerEvents = 'auto';
            if (chevron) chevron.style.transform = 'rotate(180deg)';
        }
        function hide() {
            menu.style.opacity = '0';
            menu.style.visibility = 'hidden';
            menu.style.pointerEvents = 'none';
            if (chevron) chevron.style.transform = '';
        }

        wrap.addEventListener('mouseenter', show);
        wrap.addEventListener('mouseleave', hide);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', bindPropsHover);
    } else {
        bindPropsHover();
    }
    window.addEventListener('load', bindPropsHover);
})();
</script>
