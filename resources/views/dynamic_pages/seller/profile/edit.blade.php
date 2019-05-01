@extends('layouts.app')

@section('content')


<div class="page-wrapper chiller-theme toggled">
  @include('components.sidebar')
  
  <main class="page-content {{request()->segment(2)}} {{request()->segment(3)}} {{request()->segment(4)}}">
      @include('dynamic_pages.seller.components.navbar')

      <div id="breadcrumb"> <a href="{{route('seller_home')}}" title="Go to Home"><i class="fa fa-home"></i> Home</a><a href="{{route('seller.profile.index')}}">profile</a><a href="{{route('seller.profile.edit')}}" class="current">edit</a></div>

      <div class="container-fluid">
        <h2><span><i class="fas fa-user pr-3"></i></span>Update My Profile</h2>
        <hr>

        @include('inc.messages')

        <div class="col-md-10">
        @include('dynamic_pages.myprofile.edit',['formAction' =>'seller.profile.update'])

        </div>
        </div>
      </div>
    </main>
    <!-- page-content" -->
  </div>  
@endsection