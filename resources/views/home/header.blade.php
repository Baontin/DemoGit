<header class="header_section">
    <nav class="navbar navbar-expand-lg custom_nav-container ">
      <a class="navbar-brand" href="index.html">
        <span>
          Honkai Shop
        </span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class=""></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav  ">
          <li class="nav-item {{Request::is('/') ? 'active' : ''}}">
            <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item {{Request::is('shop*') ? 'active' : ''}}">
            <a class="nav-link" href="{{url('shop')}}">
              Shop
            </a>
          </li>
          <li class="nav-item {{Request::is('why_us') ? 'active' : ''}}">
            <a class="nav-link" href="{{url('why_us')}}">
              Why Us
            </a>
          </li>
          <li class="nav-item {{Request::is('testimonial') ? 'active' : ''}}">
            <a class="nav-link" 
                href="{{url('testimonial')}}">
              Testimonial
            </a>
          </li>
          <li class="nav-item {{Request::is('contact_us') ? 'active' : ''}}">
            <a class="nav-link" href="{{url('contact_us')}}">Contact Us</a>
          </li>
        </ul>
        <div class="user_option">
          @if (Route::has('login'))
            @auth
            <a href="{{url('mycart')}}">
              <i class="fa fa-shopping-bag" aria-hidden="true"></i>
              <sup>{{$count}}</sup>
            </a>
            <div class="dropdown ">
              <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  {{Auth::user()->name}}
              </button>
              <div style="background-color: rgb(220, 223, 249);" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item " href="{{ url('mypersonal') }}">Personal</a>
                  {{-- <a class="dropdown-item" href="">Lịch sử đơn hàng</a> --}}
                  <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <button type="submit" class="dropdown-item">Log out</button>
                  </form>
              </div>
            </div>
          
          @else
          
          <a href="{{url('/login')}}">
            <i class="fa fa-user" aria-hidden="true"></i>
            <span>
              Login
            </span>
          </a>
          <a href="{{url('/register')}}">
            <i class="fa fa-vcard" aria-hidden="true"></i>
            <span>
              Register
            </span>
          </a>
            @endauth

          @endif
          
          
          {{-- <form class="form-inline ">
            <button class="btn nav_search-btn" type="submit">
              <i class="fa fa-search" aria-hidden="true"></i>
            </button>
          </form> --}}
        </div>
      </div>
    </nav>
  </header>