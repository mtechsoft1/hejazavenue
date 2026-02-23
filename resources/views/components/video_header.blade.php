<div class="container-fluid p-0 relative">
    <!-- Navbar Component -->
    @include('components.navbar')

    <!-- Video Header Area: starts directly below navbar spacer -->
    <div class="w-full min-h-[550px] relative flex flex-col justify-center items-center mt-0 pt-0">
        
        <!-- Video Background -->
        <video autoplay muted loop playsinline class="absolute top-0 left-0 w-full h-full object-cover z-0">
            <source src="{{ asset('gallary_videos/Video2.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <!-- Overlay for better text readability -->
        <div class="absolute top-0 left-0 w-full h-full bg-black/30 z-10"></div>

        <!-- Text Content -->
        <div class="relative z-20 text-center text-white mt-20 px-4">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">{{ $title ?? 'My Account' }}</h1>
            <p class="text-lg md:text-xl font-medium tracking-wide uppercase">{{ $breadcrumb ?? 'Home' }}</p>
        </div>
    </div>
</div>
