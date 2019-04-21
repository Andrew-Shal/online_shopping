@extends('layouts.app')

@section('content')


<div class="page-wrapper chiller-theme toggled">
  @include('components.sidebar')
  
  <main class="page-content {{request()->segment(2)}}">
      @include('dynamic_pages.seller.components.navbar')

      <div id="breadcrumb"> <a href="{{route('seller_home')}}" title="Go to Home"><i class="fa fa-home"></i> Home</a><a href="{{route('billing.index')}}" class="current">Billing Information</a></div>

      <div class="container-fluid">
        <h2><span><i class="fab fa-google-wallet pr-3"></i></span>Billing Information</h2>

        @include('inc.messages')
        <hr>
        <div class="row">
          <div class="col-md-10 pl-5">
            <!--get billing info from billing details-->          
            <table>
                <tbody>
                  <tr>
                    <td>Email:</td>
                    <td>{{$billingDetails->billing_email}}</td>
                  </tr>
                  <tr>
                    <td>Full Name:</td>
                    <td>{{$billingDetails->billing_name}}</td>
                  </tr>
                  <tr>
                    <td>Phone Number:</td>
                    <td>{{$billingDetails->billing_phone}}</td>
                  </tr>
                  <tr>
                    <td>Country:</td>
                    <td>{{$billingDetails->billing_province}}</td>
                  </tr>
                  <tr>
                    <td>Address:</td>
                    <td>{{$billingDetails->billing_address}}</td>
                  </tr>
                  <tr>
                    <td>City:</td>
                    <td>{{$billingDetails->billing_city}}</td>
                  </tr>
                </tbody>
              </table>
          </div>
        </div>
      </div>
  
    </main>
    <!-- page-content" -->
  </div>  
@endsection