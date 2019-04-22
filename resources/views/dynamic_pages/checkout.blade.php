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
          <div lass="row">
              {!! Form::open(['id'=>'billingInfo']) !!}
              <div class="form-group">
                {{Form::label('email', 'email')}}
                {{Form::text('email', '', ['class' => 'form-control', 'placeholder'=>'email'])}}
              </div>
              <div class="form-group">
                {{Form::label('name', 'name')}}
                {{Form::text('name', '', ['class' => 'form-control', 'placeholder'=>'name'])}}
              </div>
              <div class="form-group">
                {{Form::label('phone', 'phone')}}
                {{Form::text('phone', '', ['class' => 'form-control', 'placeholder'=>'phone'])}}
              </div>
              <div class="form-group">
                {{Form::label('province', 'province')}}
                {{Form::text('province', '', ['class' => 'form-control', 'placeholder'=>'province'])}}
              </div>
              <div class="form-group">
                {{Form::label('address', 'address')}}
                {{Form::text('address', '', ['class' => 'form-control', 'placeholder'=>'address'])}}
              </div>
              <div class="form-group">
                {{Form::label('city', 'city')}}
                {{Form::text('city', '', ['class' => 'form-control', 'placeholder'=>'city'])}}
              </div>
            {!! Form::close() !!}
          </div>
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
          <div class="row">
              <div class="col-md-8">
              <form id="payment" action="{{route('checkout.store')}}" method="POST">
                @csrf
                  <input type="hidden" name="email" value="">
                  <input type="hidden" name="name" value="">
                  <input type="hidden" name="address" value="">
                  <input type="hidden" name="city" value="">
                  <input type="hidden" name="province" value="">
                  <input type="hidden" name="phone" value="">
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
                  </div>
                </form>  
                <a href="/thankyou" class="btn btn-success" onclick="event.preventDefault();submitPayment()">Pay Now</a>
              </div>            
              <!--end -->
        </div>
      @endif
    </div>
  </div>
</div>
@endsection

@section('scripts')

@if(Request::is('guestCheckout'))
  <script>
    function submitPayment(){
      $('[name=email]',$('#payment')).val($('[name=email]',$('#billingInfo')).val());
      $('[name=name]',$('#payment')).val($('[name=name]',$('#billingInfo')).val());
      $('[name=address]',$('#payment')).val($('[name=address]',$('#billingInfo')).val());
      $('[name=city]',$('#payment')).val($('[name=city]',$('#billingInfo')).val());
      $('[name=province]',$('#payment')).val($('[name=province]',$('#billingInfo')).val());
      $('[name=phone]',$('#payment')).val($('[name=phone]',$('#billingInfo')).val());
      $('#payment').submit();
    }

  </script>
@endif

@endsection

