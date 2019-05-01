@extends('layouts.app')

@section('content')

<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

<!-- Magnific Popup core JS file -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

<script>
$(document).ready(function() {
  $('.image-link').magnificPopup({type:'image'});
});
</script>

<div class="row justify-content-center page-wrapper">
    <div class="col-md-10">
  <h2><i class="fa fa-shopping-cart mr-3"></i>Shopping Cart</h2>
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

    @if(!$products)
        <p>you don't have anything in your cart</p>
    @else
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">featured photo</th>
                    <th scope="col">name</th>
                    <th scope="col">qty</th>
                    <th scope="col">item price</th>
                    <th scope="col">sub total</th>
                </tr>
            </thead>
            <tbody>
        @foreach($products as $product)
            <tr>
                <th scope="row">{{$product['item']->id}}</th>
                <td> 
                    <div class="product_featured_photo">
                        <a href="{{asset('/storage/users/'.$product['item']->user->id.'/product_images/'. $product['item']->featured_photo)}}" class="image-link"><img src="{{asset('/storage/users/'.$product['item']->user->id.'/product_images/'. $product['item']->featured_photo)}}"/></a>
                    </div>
                </td>

                <td>{{$product['item']->name}}</td>
                <td>
                    <form action="{{route('cart.updateQty')}}" method="POST">
                    <input type="number" class="input-text qty" step="1" min="1" max="" name="qty" value="{{$product['qty']}}" size="2" pattern="[0-9]*" inputmode="numeric">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$product['item']->id}}">
                    <input type="hidden" name="_method" value="PATCH">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </form>
                </td>
                <td>${{$product['item']->current_price}}</td>
                <td>${{$product['price']}}
                    <form action="{{ route('cart.removeItem',$product['item']->id) }}" method="POST">
                        {{ csrf_field() }}
                        
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-primary">X</button>
                    </form>
                </td>
            </tr>
        @endforeach
        <tr>
            <td>Total Quantity: {{$totalQty}}</td>
            <td>Total Price: ${{$totalPrice}}</td>
        </tr>
        </tbody>
        </table>

        <a class="btn btn-primary" href="{{route('shop.product.list')}}">continue shopping</a>
        
        <div class="float-right">
            <form action="{{ route('cart.clearCart') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-primary">Clear my Cart</button>
            </form>
        </div>
        <div class="float-right mr-4">
                <a href="{{route('checkout.index')}}" type="btn" class="btn btn-success">Checkout</a>
        </div>
    @endif
    </div>
</div>

<style>
    .product_featured_photo{
        max-height:100px;
        min-height:100px;
        height:100px;
        width:100px;
        overflow:hidden;
    }

    .product_featured_photo img{
        width:100%;
    }
    .page-wrapper{
        padding-top:40px;
    }
</style>

@endsection