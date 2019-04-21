@extends('layouts.app')

@section('content')


<div class="page-wrapper chiller-theme toggled">
  @include('components.sidebar')
  
  <main class="page-content {{request()->segment(2)}} {{request()->segment(3)}} {{request()->segment(4)}}">
      @include('dynamic_pages.seller.components.navbar')

      @include('inc.messages')
      <div class="container-fluid">
        <h2><span><i class="fas fa-user pr-3"></i></span>My Profile</h2>
        <hr>
        <!--   -->
        <div class="row">
            <p><b>first name: </b>{{$user->first_name}}<br/>
            <b>last name: </b>{{$user->last_name}}<br>
            <b>email: </b>{{$user->email}}<br>
            <b>country: </b>{{$user->cust_country}}<br>
            <b>street: </b>{{$user->cust_street}}<br>
            <b>phone number: </b>{{$user->phone_number}}<br>
            <b>encrypted password: </b>{{auth()->user()->getAuthPassword()}}<br></p>
        </div>
      </div>
  
    </main>
    <!-- page-content" -->
  </div>  
@endsection