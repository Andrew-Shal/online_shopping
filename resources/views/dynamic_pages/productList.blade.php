@extends('layouts.app')

@section('content')

<h1>All Products</h1>
<hr>
<div class="row justify-content-center">
  @if(count($products) > 0)
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
    {{$products->links()}}
  @else
    <p>Unfortunately, we don't have any users who have added any products for sale</p>
  @endif
</div>

@endsection

@section('scripts')
<style>
  .card-footer-info{
    padding-left:10px;
  }

  .card .card-footer-info .rating i{
    color:#dec930;
  }
</style>
@endsection