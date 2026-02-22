{{-- Guest/Front footer --}}
<footer id="site-footer" class="bg-gray-100 border-t border-gray-200" role="contentinfo">
    <div class="lg:max-w-[1110px] w-[90%] mx-auto pt-16 pb-8">
        <div class="grid lg:grid-cols-5 md:grid-cols-3 grid-cols-1 gap-4">
            <section aria-label="Support">
                <h2 class="lg:text-lg text-md font-semibold text-gray-900">Support</h2>
                <ul class="list-none space-y-2 pt-2 lg:text-md text-sm">
                    <li><a href="{{ url('/') }}" class="text-gray-700 hover:text-gray-900">Coronavirus (COVID-19) FAQs</a></li>
                    <li><a href="{{ url('/') }}" class="text-gray-700 hover:text-gray-900">Manage your trips</a></li>
                    <li><a href="{{ url('/') }}" class="text-gray-700 hover:text-gray-900">Contact Customer Service</a></li>
                    <li><a href="{{ url('/') }}" class="text-gray-700 hover:text-gray-900">Safety Resource Center</a></li>
                </ul>
            </section>
            <section aria-label="Discover">
                <h2 class="lg:text-lg text-md font-semibold text-gray-900">Discover</h2>
                <ul class="list-none space-y-2 pt-2 lg:text-md text-sm">
                    <li><a href="{{ url('/') }}" class="text-gray-700 hover:text-gray-900">Seasonal and holiday deals</a></li>
                    <li><a href="{{ url('/') }}" class="text-gray-700 hover:text-gray-900">Travel Articles</a></li>
                    <li><a href="{{ url('/') }}" class="text-gray-700 hover:text-gray-900">hejazavenue.com for Business</a></li>
                    <li><a href="{{ url('/') }}" class="text-gray-700 hover:text-gray-900">Traveller Review Awards</a></li>
                    <li><a href="{{ url('/') }}" class="text-gray-700 hover:text-gray-900">hejazavenue.com for Travel Agents</a></li>
                </ul>
            </section>
            <section aria-label="Terms and settings">
                <h2 class="lg:text-lg text-md font-semibold text-gray-900">Terms and settings</h2>
                <ul class="list-none space-y-2 pt-2 lg:text-md text-sm">
                    <li><a href="{{ route('policy') }}" class="text-gray-700 hover:text-gray-900">Privacy & Policy</a></li>
                    <li><a href="{{ route('terms') }}" class="text-gray-700 hover:text-gray-900">Terms & conditions</a></li>
                    <li><a href="{{ route('refund') }}" class="text-gray-700 hover:text-gray-900">Refund Policy</a></li>
                    <li><a href="{{ route('terms') }}" class="text-gray-700 hover:text-gray-900">Modern Slavery Statement</a></li>
                    <li><a href="{{ route('terms') }}" class="text-gray-700 hover:text-gray-900">Human Rights Statement</a></li>
                </ul>
            </section>
            <section aria-label="About">
                <h2 class="lg:text-lg text-md font-semibold text-gray-900">About</h2>
                <ul class="list-none space-y-2 pt-2 lg:text-md text-sm">
                    <li><a href="{{ route('about_us') }}" class="text-gray-700 hover:text-gray-900">About hejazavenue.com</a></li>
                    <li><a href="{{ route('about_us') }}" class="text-gray-700 hover:text-gray-900">How We Work</a></li>
                    <li><a href="{{ url('/') }}" class="text-gray-700 hover:text-gray-900">Sustainability</a></li>
                    <li><a href="{{ url('/') }}" class="text-gray-700 hover:text-gray-900">Careers</a></li>
                    <li><a href="{{ url('/') }}" class="text-gray-700 hover:text-gray-900">Investor relations</a></li>
                    <li><a href="{{ route('contact') }}" class="text-gray-700 hover:text-gray-900">Corporate contact</a></li>
                </ul>
            </section>
        </div>
        <p class="text-xs text-center mt-8 text-gray-600">hejazavenue.com is a part of MTech Soft LLC. The world leader in online travel and related services.</p>
        <p class="text-xs text-center mt-1 text-gray-600">Copyright © hejazavenue.com™. All rights reserved.</p>
    </div>
</footer>
