@extends('layouts.app')

@section('content')


<div class="page-wrapper chiller-theme toggled">
  @include('components.sidebar')
  
  <main class="page-content {{request()->segment(2)}}">
      @include('dynamic_pages.seller.components.navbar')

      <div id="breadcrumb"> <a href="{{route('seller_home')}}" title="Go to Home"><i class="fa fa-home"></i> Home</a><a href="{{route('seller.billing.index')}}" class="current">Billing Information</a></div>

      <div class="container-fluid">
        <h2><span><i class="fab fa-google-wallet pr-3"></i></span>Billing Information</h2>

        @include('inc.messages')
        <hr>
          @include('dynamic_pages.billings.index')
      </div>
  
    </main>
    <!-- page-content" -->
  </div>  
@endsection