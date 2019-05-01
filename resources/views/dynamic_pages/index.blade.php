@extends('layouts.app')




@section('content')

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="{{asset('storage/assets/landing/slider/b1.jpg')}}" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{asset('storage/assets/landing/slider/b2.jpg')}}" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{asset('storage/assets/landing/slider/b3.jpg')}}" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>



@if($products)

<h3>Recomended For you</h3>
<hr>
<div class="row justify-content-center">
@foreach($products as $product)
<div class="card mr-4 mb-5" style="width: 18rem;">

    @if($product->featured_photo == 'noimage_placeholder.jpg')
    <a href="{{route('shop.product.detail',[$product->id,$product->slug])}}"><img class="card-img-top" src="/storage/users/default/product_images/{{$product->featured_photo}}" alt="Card image cap"></a>
    @else
    <a href="{{route('shop.product.detail',[$product->id,$product->slug])}}"><img class="card-img-top" src="/storage/users/{{$product->user_id}}/product_images/{{$product->featured_photo}}" alt="Card image cap"></a>
    @endif
    <div class="card-body">
      <h5 class="card-title text-center">${{$product->current_price}}</h5>
      <div class="card-footer-info">
      <h5 class="card-title">{{$product->name}}</h5>

      <div class="rating">
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star-o"></i>
          <i class="fa fa-star-o"></i>
      </div>
        @if($product->qty == 0)
          <div class="out-of-stock">
              <div class="inner">
                  Out Of Stock
              </div>
          </div>
        @else
        <p class="card-text">{{$product->qty}} in stock</p>
          <form id="addToCart" action="{{ route('cart.store') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{$product->id}}">
            <!--<a href="/rating/{{$product->id}}"><i class="fa fa-plus-square"></i>Rate</a>-->
          </form>
          <a href="{{ route('cart.store') }}" onclick="event.preventDefault();$(this).parent().children('form#addToCart').submit();"><i class="fa fa-plus-square mr-2"></i>Add to Cart</a>

            <a href="{{route('shop.product.detail',[$product->id,$product->slug])}}" class="float-right"><i class="fa fa-plus-square mr-2"></i>View Product</a>
        @endif
        </div>
    </div>
  </div>


@endforeach
</div>
@endif

<div class="row">
<div class="welcome" style="background-image: url('{{asset('storage/assets/landing/background-landing-section.jpg')}}');">
  <div class="overlay"></div>
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <h2>Welcome To Our Ecommerce Website</h2>
              <p>
                  Lorem ipsum dolor sit amet, an labores explicari qui, eu nostrum copiosae argumentum has. Latine propriae quo no, unum ridens expetenda id sit, <br>
at usu eius eligendi singulis. Sea ocurreret principes ne. At nonumy aperiri pri, nam quodsi copiosae intellegebat et, ex deserunt euripidis usu.                 </p>
              <p class="button"><a href="#">Read More</a></p>
          </div>
      </div>
  </div>
</div>
</div>


@if(count($recently_added) > 0)

<h3>Recently Added</h3>
<hr>
<div class="row justify-content-center">
@foreach($recently_added as $product)
<div class="card mr-4 mb-5" style="width: 18rem;">

    @if($product->featured_photo == 'noimage_placeholder.jpg')
    <a href="{{route('shop.product.detail',[$product->id,$product->slug])}}"><img class="card-img-top" src="/storage/users/default/product_images/{{$product->featured_photo}}" alt="Card image cap"></a>
    @else
    <a href="{{route('shop.product.detail',[$product->id,$product->slug])}}"><img class="card-img-top" src="/storage/users/{{$product->user_id}}/product_images/{{$product->featured_photo}}" alt="Card image cap"></a>
    @endif
    <div class="card-body">
      <h5 class="card-title text-center">${{$product->current_price}}</h5>
      <div class="card-footer-info">
      <h5 class="card-title">{{$product->name}}</h5>

      <div class="rating">
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star-o"></i>
          <i class="fa fa-star-o"></i>
      </div>
        @if($product->qty == 0)
          <div class="out-of-stock">
              <div class="inner">
                  Out Of Stock
              </div>
          </div>
        @else
        <p class="card-text">{{$product->qty}} in stock</p>
          <form id="addToCart" action="{{ route('cart.store') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{$product->id}}">
            <!--<a href="/rating/{{$product->id}}"><i class="fa fa-plus-square"></i>Rate</a>-->
          </form>
          <a href="{{ route('cart.store') }}" onclick="event.preventDefault();$(this).parent().children('form#addToCart').submit();"><i class="fa fa-plus-square mr-2"></i>Add to Cart</a>

            <a href="{{route('shop.product.detail',[$product->id,$product->slug])}}" class="float-right"><i class="fa fa-plus-square mr-2"></i>View Product</a>
        @endif
        </div>
    </div>
  </div>


@endforeach
</div>
@endif

<style>
  .welcome{
    width: 100%;
    height: auto;
    overflow: hidden;
    background: #333;
    text-align: center;
    padding: 70px 0;
    background-repeat: no-repeat;
    background-position: top center;
    background-attachment: fixed;
    -webkit-background-size: cover;
    background-size: cover;
    position: relative;
  }
</style>

@endsection


