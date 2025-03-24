   <nav class="fixed-top align-top" id="sidebar-wrapper" role="navigation">
<div class="simplebar-content" style="padding: 0px;">
    <a class="sidebar-brand" href="{{ route('admin.dashboard') }}"><span class="align-middle"> Dashboard </span></a>
        <ul class="navbar-nav align-self-stretch">
            <!-- <li class=""> 
                <a class="nav-link text-left active"  role="button" aria-haspopup="true" aria-expanded="false"><i class="flaticon-bar-chart-1"></i> <i class = "fa fa-users"></i> Users </a>
            </li> -->
            
        <!-- Start Section -->
        <li class="has-sub"> 
                <a class="nav-link collapsed text-left" href="#collapseExample2" role="button" data-toggle="collapse" ><i class="flaticon-user"></i>  <i class = "fa fa-users"></i> Manage Users</a>
                <div class="collapse menu mega-dropdown" id="collapseExample2">
                    <div class="dropmenu" aria-labelledby="navbarDropdown">
                        <div class="container-fluid ">
                            <div class="row">
                                <div class="col-lg-12 px-2">
                                    <div class="submenu-box"> 
                                        <ul class="list-unstyled m-0">
                                        <li><a href="{{ route('admin.users.index')}}"><i class = "fa fa-user"></i> &nbsp;Users</a></li>
                                            <li><a href="{{ route('admin.provider')}}"><i class = "fa fa-user"></i> &nbsp;Providers</a></li>                                             
                                        </ul>
                                    </div>
                                </div>                
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <!--End section -->
         

            <li class=""> 
                <a href = "{{ route('admin.destination.index') }}" class="nav-link text-left active"  role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list"></i>  Destinations </a>
            </li>
            <li class=""> 
                <a href = "{{ route('admin.tours.index') }}" class="nav-link text-left active"  role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list"></i>  Tours </a>
            </li>
            <li class=""> 
                <a href = "{{ route ('admin.bookings.index') }}" class="nav-link text-left active"  role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list"></i>  Bookings </a>
            </li>
            <li class=""> 
                <a href = "{{ route ('admin.user_reviews') }}" class="nav-link text-left active"  role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list"></i>  User Reviews </a>
            </li>
            <li class=""> 
                <a href = "{{ route ('admin.contactus_message') }}" class="nav-link text-left active"  role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list"></i>  Contact Us Messages </a>
            </li>

        </ul>
    </div>
</nav>