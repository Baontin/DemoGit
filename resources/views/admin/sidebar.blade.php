<div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
    <nav id="sidebar">
      <!-- Sidebar Header-->
      <div class="sidebar-header d-flex align-items-center">
        <div class="avatar"><img src="{{asset('admincss/img/avatar-6.jpg')}}" alt="..." class="img-fluid rounded-circle"></div>
        <div class="title">
          <h1 class="h5">Võ Trung Tín</h1>
          <p>Web Developer</p>
        </div>
      </div>
      <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
      <ul class="list-unstyled">
              <li class="{{Route::is('admin.index') ? 'active' : ''}}"><a href="{{route('admin.index')}}"> <i class="icon-home"></i>Dashboard</a></li>
              <li class="{{Request::is('view_category') ? 'active' : ''}}">
                <a href="{{url('view_category')}}"> 
                  <i class="icon-grid"></i>Category 
                </a>
              </li>

              <li>
                <a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="bi bi-archive"></i>Products</a>
                <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                  <li class="{{ Request::is('add_product') ? 'active' : ''}}">
                    <a href="{{url('add_product')}}">
                      <i class="bi bi-plus-circle-dotted"></i>Add Product
                    </a>
                  </li>
                  <li class="{{ Request::is('view_product') ? 'active' : ''}}">
                    <a href="{{url('view_product')}}">
                      <i class="bi bi-list"></i>View Product
                    </a>
                  </li>
                  {{-- <li><a href="#">Page</a></li> --}}
                </ul>
              </li>

              <li class="{{ Request::is('view_orders') ? 'active' : ''}}">
                <a href="{{ url('view_orders') }}"> 
                  <i class="bi bi-truck"></i>Orders 
                </a>
              </li>
      </ul><span class="heading">Extras</span>
      <ul class="list-unstyled">
        <li class="{{ Route::is('home.index') ? 'active' : '' }}">
          <a href="{{route('home.index')}}"> <i class="icon-home"></i>Home (client) </a>
        </li>
      </ul>
    </nav>