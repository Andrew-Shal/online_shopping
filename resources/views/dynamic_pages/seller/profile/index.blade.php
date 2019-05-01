@extends('layouts.app')

@section('content')


<div class="page-wrapper chiller-theme toggled">
  @include('components.sidebar')
  
  <main class="page-content {{request()->segment(2)}} {{request()->segment(3)}} {{request()->segment(4)}}">
      @include('dynamic_pages.seller.components.navbar')

      <div id="breadcrumb"> <a href="{{route('seller_home')}}" title="Go to Home"><i class="fa fa-home"></i> Home</a><a href="{{route('seller.profile.index')}}" class="current">profile</a></div>

      @include('inc.messages')
      <div class="container-fluid">
        <h2><span><i class="fas fa-user pr-3"></i></span>My Profile</h2>
        <hr>
        <!--   -->
          @include('dynamic_pages.myprofile.index') 
      </div>
  
    </main>
    <!-- page-content" -->
  </div>  
@endsection