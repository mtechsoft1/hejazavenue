<!-- <nav class="navbar navbar-default no-margin navbar-fixed-top color green" >
      <div class="fixed-brand">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" id="menu-toggle">
            <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
        </button>
        <a class="navbar-brand" href="#"><i class=""></i><span>Compass</span></a>        
        
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li class="active">
                <button class="navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle-2" style = "display: none;"> <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span></button>
            </li>
            <li id = "dp">
                <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre >
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a id = "dpa" class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">{{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
<nav class="navbar navbar-default no-margin navbar-fixed-top " style="background-color:green;">
      <div class="fixed-brand" >
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" id="menu-toggle">
            <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
        </button>
        <a class="navbar-brand" href="#"><i class=""></i><span style="color:yellow;">Compass</span></a>        
        
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li class="active">
                <button class="navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle-2" style = "display: none;"> <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span></button>
            </li>
            <li id = "dp">
                <a style = "color: yellow;" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre >
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a id = "dpa" class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">{{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav> -->







<nav class="navbar navbar-expand my-navbar" style = "background: green; color: yellow;">
      <!-- Sidebar Toggle (Topbar) -->
      <div type="button"  id="bar" class="nav-icon1 hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">
        <span></span>
        <span></span>
        <span></span>
      </div>    
      <!-- Topbar Search -->
      <form class="d-none d-sm-inline-block form-inline navbar-search">
        <div class="input-group">
          <!-- <input type="text" class="form-control bg-light " placeholder="Search for..." aria-label="Search">
          <div class="input-group-append"><button class="btn btn-primary" type="button"><i class="fas fa-search fa-sm"></i></button></div> -->
        </div>
      </form>
      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">
        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown  d-sm-none">     
          <!-- Dropdown - Messages -->
          <div class="dropdown-menu dropdown-menu-right p-3">
            <form class="form-inline mr-auto w-100 navbar-search">
              <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small"placeholder="Search for..." >
                <div class="input-group-append"><button class="btn btn-primary" type="button"><i class="fas fa-search fa-sm"></i></button></div>
              </div>
            </form>
          </div>
        </li>
        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown">
          <a class="nav-icon dropdown" href="#" id="alertsDropdown" data-toggle="dropdown" aria-expanded="false">
            <div class="position-relative">
              <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell align-middle"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
              <span class="indicator">4</span> -->
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-0" aria-labelledby="alertsDropdown">
            <div class="dropdown-menu-header">
              4 New Notifications
            </div>
            <div class="list-group">
              <a href="#" class="list-group-item">
                <div class="row no-gutters align-items-center">
                  <div class="col-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle text-danger"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                  </div>
                  <div class="col-10">
                    <div class="text-dark">Update completed</div>
                    <div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
                    <div class="text-muted small mt-1">30m ago</div>
                  </div>
                </div>
              </a>                  
            </div>
            <div class="dropdown-menu-footer">
              <!-- <a href="#" class="text-muted">Show all notifications</a> -->
            </div>
          </div>
        </li>
        <!-- Nav Item - Messages -->
        <li class="nav-item">
          <!-- <a class="nav-link " href="#"role="button"><i class="fas fa-envelope"></i> -->
            <!-- Counter - Messages -->
            <!-- <span class="badge badge-danger badge-counter">7</span> -->
          <!-- </a> -->
        </li>
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown">
          <!-- <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->first_name }}</span>
            <img class="img-profile rounded-circle" src="{{ asset('assets/img/3.png') }}">
          </a> -->
            <button class="dropbtn" style = "color:black; background: green;">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" style = "color:black;">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->first_name }}</span>
                <img class="img-profile rounded-circle" src="{{ asset('profile_images/0fvsSRgLQo.png') }}">
            </a>
            </button>
            <div class="dropdown-content">
            <a id = "dpa" class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">{{ __('Logout') }}
                    </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                <!-- <a href="#">Link 2</a>
                <a href="#">Link 3</a> -->
            </div>
        </li>
        
        <!-- <div class="dropdown"> -->
        <!-- <button class="dropbtn">Dropdown</button>
        <div class="dropdown-content">
        <a href="#">Link 1</a>
        <a href="#">Link 2</a>
        <a href="#">Link 3</a>
        </div> -->
        <!-- </div> -->

      </ul>
    </nav>