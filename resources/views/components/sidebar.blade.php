<a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
</a>

<nav id="sidebar" class="sidebar-wrapper">
  <div class="sidebar-content">
    <div class="sidebar-brand">
      <a href="/">{{config('app.name')}}</a>
      <div id="close-sidebar">
        <i class="fas fa-times"></i>
      </div>
    </div>
    <div class="sidebar-header">
      <div class="user-pic">
        <img class="img-responsive img-rounded" src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg"
          alt="User picture">
      </div>
      <div class="user-info">
        <span class="user-name">{{auth()->user()->first_name}}
          <strong>{{auth()->user()->last_name}}</strong>
        </span>
        <span class="user-role">Seller</span>
        <span class="user-status">
          <i class="fa fa-circle"></i>
          <span>Online</span>
        </span>
      </div>
    </div>
    <!-- sidebar-header  -->
    <div class="sidebar-search">
      <div>
        <div class="input-group">
          <input type="text" class="form-control search-menu" placeholder="Search...">
          <div class="input-group-append">
            <span class="input-group-text">
              <i class="fa fa-search" aria-hidden="true"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <!-- sidebar-search  -->
    <div class="sidebar-menu">
      <ul>
        <li class="header-menu">
          <span>General</span>
        </li>
        <li id="nav-dashboard" class="sidebar-dropdown">
          <a href="#">
            <i class="fa fa-tachometer-alt"></i>
            <span>Dashboard</span>
            <span class="badge badge-pill badge-warning">New</span>
          </a>
          <div class="sidebar-submenu">
            <ul>
              <li>
                <a href="{{route('buyer_home')}}">Buyers
                  <span class="badge badge-pill badge-success">Pro</span>
                </a>
              </li>
              <li>
                <a href="{{route('seller_home')}}">Sellers</a>
              </li>
            </ul>
          </div>
        </li>
        <li id="nav-e-commerce" class="sidebar-dropdown">
          <a href="#">
            <i class="fa fa-truck"></i>
            <span>Products</span>
            <span class="badge badge-pill badge-danger">2</span>
          </a>
          <div class="sidebar-submenu">
            <ul>
              <li>
                <a href="/admin/dashboard/product/create">add product

                </a>
              </li>
              <li>
                <a href="/admin/dashboard/product">list products</a>
              </li>
            </ul>
          </div>
        </li>
        <li id="nav-components" class="sidebar-dropdown">
          <a href="#">
            <i class="far fa-gem"></i>
            <span>Posts</span>
          </a>
          <div class="sidebar-submenu">
            <ul>
              <li>
                <a href="/admin/dashboard/posts/create">Add Post</a>
              </li>
              <li>
                <a href="/admin/dashboard/posts">List Posts</a>
              </li>
            </ul>
          </div>
        </li>
        <li id="nav-charts" class="sidebar-dropdown">
          <a href="#">
            <i class="fa fa-chart-line"></i>
            <span>Billing</span>
          </a>
          <div class="sidebar-submenu">
            <ul>
              <li>
                <a href="#">View</a>
              </li>
              <li>
                <a href="#">Edit</a>
              </li>
            </ul>
          </div>
        </li>
        <li id="nav-maps" class="sidebar-dropdown">
          <a href="#">
            <i class="fa fa-cog"></i>
            <span>settings</span>
          </a>
          <div class="sidebar-submenu">
            <ul>
              <li>
                <a href="#">My Profile</a>
              </li>
              <li>
                <a href="#">Update Profile</a>
              </li>
            </ul>
          </div>
        </li>
        <li class="header-menu">
          <span>Extra</span>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-book"></i>
            <span>Ratings</span>
            <span class="badge badge-pill badge-primary">Beta</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-calendar"></i>
            <span>Orders</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-folder"></i>
            <span>Examples</span>
          </a>
        </li>
      </ul>
    </div>
    <!-- sidebar-menu  -->
  </div>
  <!-- sidebar-content  -->
  <div class="sidebar-footer">
    <a href="#">
      <i class="fa fa-bell"></i>
      <span class="badge badge-pill badge-warning notification">3</span>
    </a>
    <a href="#">
      <i class="fa fa-envelope"></i>
      <span class="badge badge-pill badge-success notification">7</span>
    </a>
    <!--<a href="#">
      <i class="fa fa-cog"></i>
      <span class="badge-sonar"></span>
    </a>-->
    <a href="{{ route('logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
      <i class="fa fa-power-off"></i>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
  </div>
</nav>
  <!-- sidebar-wrapper  -->