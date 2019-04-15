@extends('layouts.app')

@section('content')

    <h1>{{$product->name}}</h1>
    
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
    
@endsection