<div class="header">
        <div class="container">
            <div class="row inner">
                <div class="col-md-4 logo">
                    <a href="/" class="navbar-brand"><img src="{{asset('storage/assets/header/online-shop-logo-thumb.png')}}"/></a>
                </div>
                <div class="col-md-8 right">
                    <ul>
                        @if(Auth::user())
                            <li class="nav-item">
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out-alt"></i>
                                            {{ __('Logout') }}
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <li><a href="{{route('buyer_home')}}"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
                        @else
                            <li><a href="{{route('login')}}"><i class="fa fa-sign-in-alt"></i> Login</a></li>
                            <li><a href="{{route('register')}}"><i class="fa fa-user-plus"></i> Register</a></li>
                        @endif
                        <li><a href="{{route('cart.index')}}"><i class="fa fa-shopping-cart"></i> View Cart ($0.00)</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="/">{{config('app.name')}}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="{{route('shop.product.list')}}">Shop <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Categories
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">see more</a>
            </div>
        </li>
        @if(Auth::user())
            @if(!Auth::user()->seller_panel_enabled)
                <li class="nav-item"><a href="{{route('about.seller.enable')}}" class="nav-link">Become a Seller</a></li>
            @else
                <li class="nav-item"><a href="/admin/dashboard" class="nav-link">Sellers panel</a></li>
            @endif
        @endif
        <li class="nav-item">
            <a class="nav-link" href="{{route('page.contact')}}">Contact Us</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('page.about')}}">About Us</a>
        </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="{{route('shop.product.search')}}" method="GET">
            <input name="search_param" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>

@section('scripts')
<script>
$(function(){
    var navbar = $('nav.navbar');
    var initPosition = navbar.offset().top;

    $(window).scroll(function(){

      if($(this).scrollTop()>=initPosition){
        navbar.addClass('stickyNav');
        $('#main').addClass('offsetNav');
      }else{
        navbar.removeClass('stickyNav');
        $('#main').removeClass('offsetNav');
      }
    });
  });
</script>
@endsection


