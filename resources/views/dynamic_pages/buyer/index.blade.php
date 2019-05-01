@extends('layouts.app')

@section('content')
<div class="contanier">
  <div class="row">
    <div class="col-md-12">
        <h2><span><i class="fas fa-user pr-3"></i></span>My Dashboard</h2>
        <hr>   

        @include('inc.messages')
      
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="recommend-tab" data-toggle="tab" href="#recommend" role="tab" aria-controls="recommend" aria-selected="false">Recommendations</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="orders-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false">Orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="billing-tab" data-toggle="tab" href="#billing" role="tab" aria-controls="orders" aria-selected="false">Billing</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>

          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row justify-content-center">
              <div class="col-md-5">
                <h2><i class="fa fa-user pr-3"></i>Account Information</h3>
                <hr>
                @include('dynamic_pages.myprofile.index')
              </div>   <!--col-md-5--> 
              <div class="col-md-5">
                  <h2><i class="fa fa-user pr-3"></i>Edit Account Information</h3>
                    <hr>
                  @include('dynamic_pages.myprofile.edit',['formAction' => 'buyer.profile.update'])
              </div>  <!--col-md-5-->
            </div>  <!--row-->
          </div>  <!--#profile-->

          <div class="tab-pane fade" id="recommend" role="tabpanel" aria-labelledby="recommend-tab">
              <div class="row justify-content-center">
                  <div class="col-md-10">
                    <h2><i class="fa fa-user pr-3"></i>Recommendations for you</h3>
                    <hr>
                    @include('dynamic_pages.recommendations.index')
                  </div>   <!--col-md-10--> 
              </div>  <!--row-->
          </div>  <!--#orders-->
          
          <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
              <div class="row justify-content-center">
                  <div class="col-md-10">
                    <h2><i class="fa fa-user pr-3"></i>Order History</h3>
                    <hr>
                    @include('dynamic_pages.myorders.index')
                  </div>   <!--col-md-10--> 
              </div>  <!--row-->
          </div>  <!--#orders-->
          
          <div class="tab-pane fade" id="billing" role="tabpanel" aria-labelledby="billing-tab">
              <div class="row justify-content-center">
                  <div class="col-md-5">
                    <h2><i class="fa fa-user pr-3"></i>Billing Information</h3>
                    <hr>
                    @if($billingInfo != null)
                    @include('dynamic_pages.billings.index')
                  </div>   <!--col-md-5--> 
                    <div class="col-md-5">
                      <h2><i class="fa fa-user pr-3"></i>Edit Billing Information</h3>
                        <hr>
                      @include('dynamic_pages.billings.edit',['formAction' => 'buyer.billing.update'])
                   </div>  <!--col-md-5-->
                   @else
                   
                    <p>you don't have any billing information</p>
                  </div>   <!--col-md-5--> 
                    <div class="col-md-5">
                      <h2><i class="fa fa-user pr-3"></i>Create Billing Information</h3>
                        <hr>
                      @include('dynamic_pages.billings.create')
                   </div>  <!--col-md-5-->
                   
                   @endif
                   
              </div>  <!--row-->
          </div>  <!--#billing-->
        </div>
    </div>
  </div>
</div>

@endsection