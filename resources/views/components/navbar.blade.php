<div id="home-page" class="w-100 absolute top-0 left-0 z-[1000] py-4 px-6 flex justify-center">
    <!-- Main Navbar Container with Glass Background -->
    <div class="lg:max-w-[1400px] w-full flex items-center justify-between px-8 py-2">
        
        <!-- 1. Logo (Totally Left) -->
        <div class="flex-shrink-0">
            <a href="{{ route('index') }}" class="text-white text-decoration-none flex items-center">
                <div class="w-[60px] h-[100px] transition-transform hover:scale-105 duration-300">
                    <img class="w-full h-full object-contain" src="{{ asset('./img/logo.png') }}" alt="logo" />
                </div>
            </a>
        </div>

        <!-- 2. Desktop Navigation & Auth Group (Right side) -->
        <div class="hidden lg:flex items-center gap-8">
            
            <!-- Home Link -->
            <a href="{{ route('index') }}" class="text-white text-decoration-none text-md font-bold hover:text-green-400 transition-colors flex items-center gap-2">
                <i class="fa fa-home text-lg"></i>
                <span>Home</span>
            </a>
            
            <!-- Properties Dropdown (White Button Style like Register) -->
            <div class="relative dropdown-container" x-data="{ open: false }" @click.outside="open = false">
                <button type="button" @click="open = !open" class="bg-white hover:bg-gray-100 text-black px-7 py-3 rounded-full text-md font-bold flex items-center gap-2 transition-all shadow-lg active:scale-95 border-0">
                    <i class="fa fa-building text-md text-green-600"></i>
                    <span>Properties</span>
                    <i class="fa fa-chevron-down text-[10px] transition-transform duration-300" :class="open ? 'rotate-180' : ''"></i>
                </button>
                <!-- Dropdown Content (Clean White Background) -->
                <div x-show="open" 
                     style="display: none;"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 translate-y-2"
                     class="absolute left-0 mt-3 w-60 bg-white text-gray-900 rounded-2xl shadow-[0_15px_50px_rgba(0,0,0,0.15)] py-3 z-[9999] border border-gray-100 overflow-hidden">
                     <a href="#" class="flex items-center gap-4 px-6 py-4 text-md font-bold hover:bg-gray-50 hover:text-green-600 transition-all text-gray-800 text-decoration-none">
                        <i class="fa fa-home-alt text-green-600 w-5 text-center"></i> 
                        <span>Residential</span>
                     </a>
                     <a href="#" class="flex items-center gap-4 px-6 py-4 text-md font-bold hover:bg-gray-50 hover:text-green-600 transition-all text-gray-800 text-decoration-none">
                        <i class="fa fa-key text-green-600 w-5 text-center"></i> 
                        <span>Rental</span>
                     </a>
                     <a href="#" class="flex items-center gap-4 px-6 py-4 text-md font-bold hover:bg-gray-50 hover:text-green-600 transition-all text-gray-800 text-decoration-none">
                        <i class="fa fa-calendar-check text-green-600 w-5 text-center"></i> 
                        <span>Book</span>
                     </a>
                </div>
            </div>

            <!-- Other Nav Links -->
            <nav class="flex items-center gap-8">
                <a href="{{ route('contact') }}" class="text-white text-decoration-none text-md font-bold hover:text-green-400 transition-colors flex items-center gap-2">
                    <span>Apartments</span>
                </a>
                <a href="{{ route('contact') }}" class="text-white text-decoration-none text-md font-bold hover:text-green-400 transition-colors flex items-center gap-2">
                    <span>Maps</span>
                </a>
                <a href="{{ route('about_us') }}" class="text-white text-decoration-none text-md font-bold hover:text-green-400 transition-colors flex items-center gap-2">
                    <span>About Us</span>
                </a>
                <a href="{{ route('contact') }}" class="text-white text-decoration-none text-md font-bold hover:text-green-400 transition-colors flex items-center gap-2">
                    <span>Contact Us</span>
                </a>
            </nav>

            <!-- Auth Group -->
            <div class="flex items-center gap-6 ml-4 border-l border-white/20 pl-8">
                @auth
                    <a href="{{ route('home') }}" class="text-white text-md font-bold hover:text-green-400 transition-colors text-decoration-none">My Account</a>
                    <a href="{{ route('logout') }}" class="bg-red-500 hover:bg-red-600 text-white text-md font-bold py-3 px-8 rounded-full transition-all shadow-lg text-decoration-none">Logout</a>
                @else
                    <a href="{{ route('login') }}" class="text-white text-md font-bold hover:text-green-400 transition-colors text-decoration-none">Sign In</a>
                    <a href="{{ route('register') }}" class="bg-white text-black hover:bg-gray-200 text-md font-bold py-3 px-8 rounded-full transition-all shadow-lg text-decoration-none">Register</a>
                @endauth
            </div>
        </div>

        <!-- Mobile Controls -->
        <div class="lg:hidden">
            <button id="menu-toggle" class="text-white p-2">
                <i class="fa fa-bars text-2xl"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden absolute top-full left-0 w-full bg-black/95 backdrop-blur-xl p-8 border-t border-white/5 shadow-2xl z-[200]">
        <div class="flex flex-col gap-6">
            <a href="{{ route('index') }}" class="text-white text-xl font-bold text-decoration-none">Home</a>
            <div class="flex flex-col gap-4" x-data="{ mobPropOpen: false }">
                <button @click="mobPropOpen = !mobPropOpen" class="text-white text-xl font-bold flex items-center justify-between">
                    <span>Properties</span>
                    <i class="fa fa-chevron-down decoration-none transition-transform duration-300" :class="mobPropOpen ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="mobPropOpen" x-collapse class="pl-6 flex flex-col gap-4 border-l border-white/10 mt-2">
                    <a href="#" class="text-white/70 text-lg hover:text-white text-decoration-none">Residential</a>
                    <a href="#" class="text-white/70 text-lg hover:text-white text-decoration-none">Rental</a>
                    <a href="#" class="text-white/70 text-lg hover:text-white text-decoration-none">Book</a>
                </div>
            </div>
            <a href="{{ route('contact') }}" class="text-white text-xl font-bold text-decoration-none">Apartments</a>
            <a href="{{ route('contact') }}" class="text-white text-xl font-bold text-decoration-none">Maps</a>
            <a href="{{ route('about_us') }}" class="text-white text-xl font-bold text-decoration-none">About Us</a>
            <a href="{{ route('contact') }}" class="text-white text-xl font-bold text-decoration-none">Contact Us</a>
            <div class="flex flex-col gap-4 pt-6 border-t border-white/10">
                @auth
                    <a href="{{ route('home') }}" class="text-white text-center font-bold text-lg">My Account</a>
                @else
                    <a href="{{ route('login') }}" class="text-white text-center font-bold text-lg">Sign In</a>
                    <a href="{{ route('register') }}" class="bg-white text-black text-center py-3 rounded-full font-bold text-lg">Register</a>
                @endauth
            </div>
        </div>
    </div>
</div>
