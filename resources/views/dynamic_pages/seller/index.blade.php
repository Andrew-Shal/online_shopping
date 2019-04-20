@extends('layouts.app')

@section('content')


<div class="page-wrapper chiller-theme toggled">
  @include('components.sidebar')
  
  <main class="page-content {{request()->segment(2)}}">
      @include('dynamic_pages.seller.components.navbar')
      <div class="container-fluid">
        <h2><span><i class="fa fa-tachometer-alt pr-3"></i></span>Dashboard</h2>
        <hr>
        <!--Action boxes-->
        <div class="row">
          <div class="quick-actions_homepage">
              <ul class="quick-actions">
                  <li class="bg_lb"> <a href="index.html"> <i class="fa fa-tachometer-alt"></i> <span class="label bg-danger">20</span> My Dashboard </a> </li>
                  <li class="bg_lg span3"> <a href="charts.html"> <i class="fa fa-signal"></i> Charts</a> </li>
                  <li class="bg_ly"> <a href="widgets.html"> <i class="fa fa-inbox"></i><span class="label bg-success">101</span> Widgets </a> </li>
                  <li class="bg_lo"> <a href="tables.html"> <i class="fa fa-th"></i> Tables</a> </li>
                  <li class="bg_ls"> <a href="buttons.html"> <i class="fa fa-tint"></i> Buttons</a> </li>
                  <li class="bg_lb"> <a href="interface.html"> <i class="fa fa-pencil-alt"></i>Elements</a> </li>
                  <li class="bg_lg"> <a href="calendar.html"> <i class="fa fa-calendar"></i> Calendar</a> </li>
                  <li class="bg_lr"> <a href="error404.html"> <i class="fa fa-bug"></i> Error</a> </li>

              </ul>
          </div>
        </div>
      </div>
  
    </main>
    <!-- page-content" -->
  </div>  
@endsection
