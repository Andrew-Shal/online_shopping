<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- scripts -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

            
    <!-- Styles -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">            
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app" class="{{request()->segment(1)}}">
        @if(request()->segment(1) != 'admin')@include('inc.navbar')@endif
        <div class="container-fluid">
            @include('inc.messages')
            @yield('content')
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    @yield ('scripts')

    
    @if(request()->segment(1) == 'admin')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" 
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" 
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>

        <script>

            window.onload = function(){
            if(localStorage.getItem('sidebar_toggle') == 'null'){
                $('div.page-wrapper').addClass('toggled');
            }else{
                $('div.page-wrapper').addClass(localStorage.getItem('sidebar_toggle'));
            }
            }

            if(localStorage.getItem('sidebar_sub_select') != 'null'){
            var element = localStorage.getItem('sidebar_sub_select');
            $(`#${element}`).addClass('active');
            $(`#${element} .sidebar-submenu`).attr('style','display:block;');
            }

            jQuery(function ($) {
            $(".sidebar-dropdown > a").click(function() {
                $(".sidebar-submenu").slideUp(500);

                if ($(this).parent().hasClass("active")) {

                $(".sidebar-dropdown").removeClass("active");
                $(this).parent().removeClass("active");
                localStorage.removeItem('sidebar_sub_select');

                } else {

                $(".sidebar-dropdown").removeClass("active");
                $(this).next(".sidebar-submenu").slideDown(400);
                $(this).parent().addClass("active");
                localStorage.setItem('sidebar_sub_select',$(this).parent().attr('id'));

                }
            });

            $("#close-sidebar").click(function() {
                $(".page-wrapper").removeClass("toggled");
                localStorage.setItem('sidebar_toggle','')
            });
            $("#show-sidebar").click(function() {
                $(".page-wrapper").addClass("toggled");
                localStorage.setItem('sidebar_toggle','toggled')
            });

            });
        </script>
    @endif
    
</body>
</html>