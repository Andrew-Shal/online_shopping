@extends('layouts.app')

@section('content')


@if (session()->has('success_message'))          
<div class="alert alert-success">          <!-- this shows the success feedback form the system if any -->
    {{ session()->get('success_message') }}
</div>
@endif


<h1>Products</h1>
<div class="row">
@if(count($products) > 0)
  @foreach($products as $product)
  <div class="card" style="width: 18rem;">
        @if($product->featured_photo == 'noimage_placeholder.jpg')
        <a href="/products/{{$product->id}}/{{$product->name}}"><img class="card-img-top" src="/storage/users/default/product_images/{{$product->featured_photo}}" alt="Card image cap"></a>
        @else
        <a href="/products/{{$product->id}}/{{$product->name}}"><img class="card-img-top" src="/storage/users/{{$product->user_id}}/product_images/{{$product->featured_photo}}" alt="Card image cap"></a>
        @endif
        <div class="card-body">
          <h5 class="card-title">{{$product->name}}</h5>
          <p class="card-text">{{$product->description}}</p>
          <h3><a href="/product/{{$product->id}}"></a></h3>
          <h4>${{$product->current_price}}</h4>
        </div>
        <div class="card-body">
                @if($product->qty == 0)
                <div class="out-of-stock">
                    <div class="inner">
                        Out Of Stock
                    </div>
                </div>
            @else
            <h4>{{$product->qty}} in stock</h4>
              <form action="{{ route('cart.store') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{$product->id}}">
                <button type="submit" class="btn btn-primary">Add to Cart</button>
                <a href="/rating/{{$product->id}}" class="btn btn-primary">Rate</a>
              </form>
            @endif
          
        </div>
      </div>
  @endforeach
  {{$products->links()}}
@else
  <p>You haven't added any Products</p>
@endif
</div>

@endsection