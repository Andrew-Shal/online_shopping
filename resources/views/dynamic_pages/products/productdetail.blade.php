@extends('layouts.app')

@section('content')


<div class="page-wrapper chiller-theme toggled">
  @include('components.sidebar')
  
  <main class="page-content {{request()->segment(2)}}">
      @include('dynamic_pages.seller.components.navbar')

      <div id="breadcrumb"> <a href="{{route('seller_home')}}" title="Go to Home"><i class="fa fa-home"></i> Home</a><a href="{{route('product.index')}}">Products</a><a href="{{route('product.show',$product->id)}}" class="current">{{$product->name}}</a></div>

      <div class="container-fluid">
        <h2><span><i class="fa fa-truck pr-3"></i></span>{{$product->name}}</h2>
        <hr>
        
        @if (session()->has('success'))          
          <div class="alert alert-success">          <!-- this shows the success feedback form the system if any -->
              {{ session()->get('success') }}
          </div>
        @endif

        <?php
        $json = json_encode(json_decode($product), JSON_PRETTY_PRINT); 
        echo '<pre>'; 
        echo $json;
        echo '</pre>'; 
    
        $json = json_encode(json_decode($product_photos), JSON_PRETTY_PRINT); 
        echo '<pre>'; 
        echo $json;
        echo '</pre>';
        
        ?>
        <p>featured img</p>
        
        <!--featured image-->
        @if($product->featured_photo == 'noimage_placeholder.jpg')
          <img class="card-img-top" src="/storage/users/default/product_images/{{$product->featured_photo}}" alt="Card image cap">
        @else
          <img class="card-img-top" src="/storage/users/{{$product->user_id}}/product_images/{{$product->featured_photo}}" alt="Card image cap">
        @endif
        <h3>Price</h3>
        <p>{{$product->presentPrice()}}</p>
        <p>other img</p>
    
        <!--other images -->
        @if(count($product_photos) > 0)
            <?php
            $idx = 1;
            foreach($product_photos as $productPhoto){
            ?>
              <img id="test{{$idx}}" src="/storage/users/{{$product->user_id}}/product_images/{{$productPhoto->photo}}"/>
            <?php
              $idx+=1;
            }
            ?>
        @endif


        
      </div>
  
  </main>
    <!-- page-content" -->
</div>  
@endsection