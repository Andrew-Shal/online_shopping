@extends('layouts.app')

@section('content')


<div class="page-wrapper chiller-theme toggled">
  @include('components.sidebar')
  
  <main class="page-content {{request()->segment(2)}} {{request()->segment(3)}} {{request()->segment(4)}}">
      @include('dynamic_pages.seller.components.navbar')

      <div id="breadcrumb"> <a href="{{route('seller_home')}}" title="Go to Home"><i class="fa fa-home"></i> Home</a><a href="{{route('seller.billing.index')}}">Billing Information</a><a href="{{route('seller.billing.edit')}}" class="current">edit</a></div>
      
      <div class="container-fluid">
        <h2><span><i class="fab fa-google-wallet pr-3"></i></span>Update Billing Information</h2>
        <hr>
        <!--   -->
        <div class="row">
            
          @include('dynamic_pages.billings.edit',['formAction' => 'seller.billing.update'])
        </div>
      </div>
  
    </main>
    <!-- page-content" -->
  </div>  
@endsection