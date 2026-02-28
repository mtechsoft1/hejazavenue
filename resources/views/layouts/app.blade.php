<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> 
    <script>
        window.axios = axios;
        window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        let token = document.head.querySelector('meta[name="csrf-token"]');
        if (token) {
            window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
        }
    </script>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/locdetails.css') }}" />
    <!-- Removed BS4 CSS Conflict -->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    @if(file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        {{-- Suppress Tailwind CDN + line-clamp plugin console warnings --}}
        <script>
        (function(){var w=console.warn;console.warn=function(m){if(typeof m==='string'&&(m.indexOf('cdn.tailwindcss.com')!==-1||m.indexOf('line-clamp')!==-1))return;w.apply(console,arguments);};})();
        </script>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        /* Bootstrap Validation Override for Custom Styling */
        .form-control.is-invalid {
            border-color: #dc3545 !important;
            background-image: none !important;
            padding-right: calc(1.5em + 0.75rem) !important;
            background-position: right calc(0.375em + 0.1875rem) center !important;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem) !important;
            background-repeat: no-repeat !important;
        }
        
        .form-control.is-valid {
            border-color: #198754 !important;
            background-image: none !important;
            padding-right: calc(1.5em + 0.75rem) !important;
            background-position: right calc(0.375em + 0.1875rem) center !important;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem) !important;
            background-repeat: no-repeat !important;
        }
        
        .form-control.is-invalid:focus {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25) !important;
        }
        
        .form-control.is-valid:focus {
            border-color: #198754 !important;
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25) !important;
        }
        
        .invalid-feedback {
            display: none !important;
            width: 100% !important;
            margin-top: 0.25rem !important;
            font-size: 0.875em !important;
            color: #dc3545 !important;
            font-weight: 400 !important;
        }
        
        /* Show invalid-feedback only when parent has is-invalid class */
        .is-invalid ~ .invalid-feedback,
        .was-validated .form-control:invalid ~ .invalid-feedback {
            display: block !important;
        }
        
        /* Keep server-side errors visible */
        .invalid-feedback:not(.d-none):not([style*="display: none"]) {
            display: block !important;
        }
        
        .valid-feedback {
            display: none !important;
            width: 100% !important;
            margin-top: 0.25rem !important;
            font-size: 0.875em !important;
            color: #198754 !important;
            font-weight: 400 !important;
        }
        
        .was-validated .form-control:invalid:focus {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25) !important;
        }
        
        .was-validated .form-control:valid:focus {
            border-color: #198754 !important;
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25) !important;
        }
        
        /* Ensure only error feedback is visible when appropriate */
        .was-validated .form-control:valid ~ .valid-feedback {
            display: none !important;
        }
        
        /* Override any conflicting styles */
        .form-control {
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out !important;
        }
        
        /* Hide all client-side error messages by default */
        .invalid-feedback[id$="-feedback"] {
            display: none !important;
        }
        
        /* Show client-side error messages only when field is invalid and form was submitted */
        .was-validated .is-invalid ~ .invalid-feedback[id$="-feedback"] {
            display: block !important;
        }
    </style>


    <style>
    .form-control-plaintext {
        background-color: #f5f8fa;
    }

    label {
        float: left;
    }

    .submit-button {
        margin-top: 15px;
        margin-bottom: 15px;
        padding: 12px 78px;
        border-radius: 30px;
        font-size: 16px;
    }

    @media (min-width: 1400px) {

        .container,
        .container-lg,
        .container-xl,
        .container-xxl {
            max-width: 1620px;
        }
    }

    #currencyModal {
        z-index: 100;
    }

    .cmodal {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    </style>
    @yield('style')
</head>

<body>
    
    <div class="row" id="SessionMessage">
        <div class="col-md-12 text-center">
            @if(session()->has('success'))
                <div class="alert alert-success text-center">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger text-center">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div> 
    </div>


    @unless(View::hasSection('hide_navbar'))
        @include('components.navbar')
    @endunless

    <div class="container-fluid pt-0">

        @yield('content')

        {{-- <!-------------Footer---------------------> --}}
        <div id="home-page" class="bg-gray-100">
            <div class="lg:max-w-[1110px] w-[90%] mx-auto  pt-16 pb-8">
                <div class="grid lg:grid-cols-5 md:grid-cols-3 grid-cols-1 gap-4">
                    <!-- Support Section -->
                    <div>
                        <h1 class="lg:text-lg text-md font-semibold">Support</h1>
                        <ul class="list-none space-y-2 px-0 pt-2 lg:text-md text-sm">
                            <li><a href="/" class="text-gray-900 hover:text-gray-900">Coronavirus (COVID-19) FAQs</a>
                            </li>
                            <li><a href="/" class="text-gray-900 hover:text-gray-900">Manage your trips</a></li>
                            <li><a href="/" class="text-gray-900 hover:text-gray-900">Contact Customer Service</a></li>
                            <li><a href="/" class="text-gray-900 hover:text-gray-900">Safety Resource Center</a></li>
                        </ul>
                    </div>

                    <!-- Discovers Section -->
                    <div>
                        <h1 class="lg:text-lg text-md font-semibold">Discovers</h1>
                        <ul class="list-none space-y-2 px-0 pt-2 lg:text-md text-sm">
                            <!--<li><a href="/" class="text-gray-900 hover:text-gray-900">Genius loyalty program</a></li>-->
                            <li><a href="/" class="text-gray-900 hover:text-gray-900">Seasonal and holiday deals</a></li>
                            <li><a href="/" class="text-gray-900 hover:text-gray-900">Travel Articles</a></li>
                            <li><a href="/" class="text-gray-900 hover:text-gray-900">hejazavenue.com for Business</a></li>
                            <li><a href="/" class="text-gray-900 hover:text-gray-900">Traveller Review Awards</a></li>
                            <!--<li><a href="/" class="text-gray-900 hover:text-gray-900">Car rental</a></li>-->
                            <!--<li><a href="/" class="text-gray-900 hover:text-gray-900">Flight finder</a></li>-->
                            <!--<li><a href="/" class="text-gray-900 hover:text-gray-900">Restaurant reservations</a></li>-->
                            <li><a href="/" class="text-gray-900 hover:text-gray-900">hejazavenue.com for Travel Agents</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Terms and settings Section -->
                    <div>
                        <h1 class="lg:text-lg text-md font-semibold">Terms and settings</h1>
                        <ul class="list-none space-y-2 px-0 pt-2 lg:text-md text-sm">
                            <li><a href="{{ route('policy') }}" class="text-gray-900 hover:text-gray-900">Privacy & Policy</a></li>
                            <li><a href="{{ route('terms') }}" class="text-gray-900 hover:text-gray-900">Terms & conditions</a></li>
                            <li><a href="{{ route('refund') }}" class="text-gray-900 hover:text-gray-900">Refund Policy</a></li>
                            <li><a href="{{ route('terms') }}" class="text-gray-900 hover:text-gray-900">Modern Slavery Statement</a></li>
                            <li><a href="{{ route('terms') }}" class="text-gray-900 hover:text-gray-900">Human Rights Statement</a></li>
                        </ul>
                    </div>

                    <!-- Partners Section -->
                    {{--
                    <div>
                        <h1 class="lg:text-lg text-md font-semibold">Partners</h1>
                        <ul class="list-none space-y-2 px-0 pt-2 lg:text-md text-sm">
                            <li><a href="/" class="text-gray-900 hover:text-gray-900">Extranet login</a></li>
                            <li><a href="/" class="text-gray-900 hover:text-gray-900">Partner help</a></li>
                            <li><a href="/" class="text-gray-900 hover:text-gray-900">List your Tour</a></li>
                            <li><a href="{{ route('register_company') }}" class="text-gray-900 hover:text-gray-900">Become an affiliate</a></li>
                        </ul>
                    </div>
                    --}}

                    <!-- About Section -->
                    <div>
                        <h1 class="lg:text-lg text-md font-semibold">About</h1>
                        <ul class="list-none space-y-2 px-0 pt-2 lg:text-md text-sm">
                            <li><a href="{{ route('about_us') }}" class="text-gray-900 hover:text-gray-900">About hejazavenue.com</a></li>
                            <li><a href="{{ route('about_us') }}" class="text-gray-900 hover:text-gray-900">How We Work</a></li>
                            <li><a href="/" class="text-gray-900 hover:text-gray-900">Sustainability</a></li>
                            <!--<li><a href="/" class="text-gray-900 hover:text-gray-900">Press center</a></li>-->
                            <li><a href="/" class="text-gray-900 hover:text-gray-900">Careers</a></li>
                            <li><a href="/" class="text-gray-900 hover:text-gray-900">Investor relations</a></li>
                            <li><a href="{{ route('contact') }}" class="text-gray-900 hover:text-gray-900">Corporate contact</a></li>
                        </ul>
                    </div>
                </div>

                <div>
                    <p class="text-xs text-center mt-5">
                        hejazavenue.com is a part of MTech Soft LLc. the world leader in online travel and related
                        services.</p>
                    <p class="text-xs text-center mt-1">Copyright © hejazavenue.com™. All rights reserved.</p>
                </div>

            </div>
        </div>

    </div>


    {{-- Font Awesome: use CDN in head (fa 4.7), kit removed - was 403 --}}
    <!-- Use proper full jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Removed conflicting BS4 JS -->
    
    <script>
        setTimeout(function() {
         $('#SessionMessage').remove();
        }, 3000); 
    </script>
    
    <script>
        function addToFavourites(itemid) {
            var item_id = itemid;
            var _token ="{{ csrf_token() }}";
            
            $.ajax({
               type:'POST',
               url:"{{ route('user.addfavourite') }}",
               data:{_token:_token, item_id:item_id},
               dataType: 'JSON',
               success:function(response){
                   
                     $('.addfavourites' + item_id).css({
                        'color': '#ffffff'
                    });  
                    
                }
            });
        }
    </script>
    <script>
        function removeFavourites(itemid) {
            var item_id = itemid;
            var _token ="{{ csrf_token() }}";
            
            
            $.ajax({
               type:'POST',
               url:"{{ route('user.addfavourite') }}",
               data:{_token:_token, item_id:item_id},
               dataType: 'JSON',
               success:function(response){
                   
                     $('.addfavourites' + item_id).css({
                        'color': '#212529'
                    }); 
                }
            });
        }
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile Menu Toggle
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        if(menuToggle && mobileMenu) {
            menuToggle.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
    });
    </script>

    <script>
    // pkr currency Modal script
    const openModalButton = document.getElementById("openModal");
    const currencyModal = document.getElementById("currencyModal");
    const closeModalButton = document.getElementById("closeModal");
    const currencyOptions = document.querySelectorAll("#currencyOptions button");


    // openModalButton.addEventListener("click", (event) => {
    //     event.stopPropagation();
    //     currencyModal.classList.remove("hidden");
    //     document.body.style.overflow = "hidden";
    // });


    // closeModalButton.addEventListener("click", () => {
    //     currencyModal.classList.add("hidden");
    //     document.body.style.overflow = "";
    // });

    currencyOptions.forEach((option) => {
        option.addEventListener("click", () => {
            const selectedCurrency = option.dataset.value;
            openModalButton.textContent = selectedCurrency;
            currencyModal.classList.add("hidden");
            document.body.style.overflow = "";
        });
    });

    window.addEventListener("click", (event) => {
        if (event.target === currencyModal) {
            currencyModal.classList.add("hidden");
            document.body.style.overflow = "";
        }
    });

    // pkr currency Modal script end
    </script>
    @yield('script')
</body>

</html>