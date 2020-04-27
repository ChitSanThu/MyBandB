<nav class="navbar navbar-expand-lg navbar-light" style="background-color:#545b62">
    <a class="navbar-brand mr-5 text-white" href="{{url('/user/5')}}">My B&B</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link text-white" href="{{url('/user/5')}}">Frontdesk <span class="sr-only">(current)</span></a>
        </li>
        <!-- <li class="nav-item mr-5">
          <a class="nav-link" href="">HouseKeeping</a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link text-white" href="{{url('user/report/frontdesk')}}">Report</a>
        </li>
        <form class="form-inline my-2 my-lg-0 ml-5">
            <input class="form-control form-control-sm mr-sm-2"  onkeyup="showHint(this.value)" id="search" name="search" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-sm btn-outline-dark text-white" type="submit">Search</button>
          </form>
        
        
      </ul>
      <ul class="navbar-nav">
      <li class="nav-item dropdown">
          @if(Auth::check())
          <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{Auth::user()->name}}
          </a>
          @else
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            User
          </a>
          @endif
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            @if(Auth::check())
            <a class="dropdown-item" href="{{url('/staff/logout')}}">Logout</a>
            @else
            <a class="dropdown-item" href="{{url('staff/login')}}">Login</a>
            <a class="dropdown-item" href="{{url('staff/register')}}">Register</a>
            @endif
            {{-- <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a> --}}
          </div>
        </li>
      </ul>
    </div>
  </nav>