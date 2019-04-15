@extends('layouts.app')

@section('content')
<h1>Checkout</h1>
<hr>

@if (session()->has('success_message'))
    <div class="alert alert-success">
        {{ session()->get('success_message') }}
    </div>
@endif

@if(count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
  <div class="row">
    <div class="col-md-6">
      <h3>Billing Details</h3>
        @if(auth()->user())
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
        @else
          <!--this user is a guest billing info from billing details-->
          
          <table>
              <form method="POST" action = {{route('checkout.store')}}>
                @csrf
              <tbody>
                <tr>
                  <td>Email:</td>
                  <td><input type="text" name="email"></td>
                </tr>
                <tr>
                  <td>Full Name:</td>
                  <td><input type="text" name="name"></td>
                </tr>
                <tr>
                  <td>Phone Number:</td>
                  <td><input type="text" name="phone"></td>
                </tr>
                <tr>
                  <td>Country:</td>
                  <td><input type="text" name="province"></td>
                </tr>
                <tr>
                  <td>Address:</td>
                  <td><input type="text" name="address"></td>
                </tr>
                <tr>
                  <td>City:</td>
                  <td><input type="text" name="city"></td>
                </tr>
              </tbody>

              <input type="hidden" name="total_price" value="{{$totalPrice}}">
            </form>
            </table>
        @endif
    </div>
    <div class="col-md-6">
        <h3>Orders Details</h3>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
        @foreach($products as $product)
            <tr>
                <th scope="row">{{$product['item']->id}}</th>
                <td>{{$product['item']->name}}</td>
                <td>{{$product['qty']}}</td>
                <td>${{$product['item']->current_price}}</td>
                <td>${{$product['price']}}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="5" style="text-align:right;"><b>Total Price:</b> ${{$totalPrice}}</td>
        </tr>
        </tbody>
        </table>
        <a href="/cart" role="button" class="btn btn-success"> back to cart</a>
      </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <h3>Payment Details</h3>
      <hr>
      @if(auth()->user())
        @if($billingDetails->isBillingIncomplete())
          <!--billing info not completely filled-->
          <p>You must fill all the billing information from your dashboard panel in order to checkout the order. Please fill up the information going to this <a href="/dashboard/billings/">link</a></p>
          @else


          <div class="row">

                <form action="{{route('checkout.store')}}" method="POST">
                  @csrf
                    <input type="hidden" name="email" value="{{$billingDetails->billing_email}}">
                    <input type="hidden" name="name" value="{{$billingDetails->billing_name}}">
                    <input type="hidden" name="address" value="{{$billingDetails->billing_address}}">
                    <input type="hidden" name="city" value="{{$billingDetails->billing_city}}">
                    <input type="hidden" name="province" value="{{$billingDetails->billing_province}}">
                    <input type="hidden" name="phone" value="{{$billingDetails->billing_phone}}">
                    <input type="hidden" name="total_price" value="{{$totalPrice}}">
                    <div class="col-md-12 form-group">
                        <label for="">Name on Card *</label>
                        <input type="text" name="billing_name_on_card" class="form-control">
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="">Card Number *</label>
                        <input type="text" name="card_number" class="form-control">
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="">CVV *</label>
                        <input type="text" name="card_cvv" class="form-control card-cvc">
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="">Month *</label>
                        <input type="text" name="card_month" class="form-control card-expiry-month">
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="">Year *</label>
                        <input type="text" name="card_year" class="form-control card-expiry-year">
                    </div>
                    <div class="col-md-12 form-group">
                        <input type="submit" class="btn btn-primary" value="Pay Now">
                    </div>
                </form>              
                <!--end -->
          </div> 
        @endif
      @else
          <p>guest payment method</p>
      @endif
    </div>
  </div>
</div>
@endsection

