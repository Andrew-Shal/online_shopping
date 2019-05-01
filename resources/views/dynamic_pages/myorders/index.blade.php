<div class="row">

    @if(count($user->orders()->get()) > 0 )
      @foreach($user->orders()->get() as $order)
      <p>
        <b>Billing Id: </b>{{$order->id}}<br/>
        <b>Billing Name: </b>{{$order->billing_name}}<br/>
        <b>Billing Address: </b>{{$order->billing_address}}<br/>
        <b>Billing City: </b>{{$order->billing_city}}<br/>
        <b>Billing Province: </b>{{$order->billing_province}}<br/>
        <b>Billing Phone: </b>{{$order->billing_phone}}<br/>
        <b>Name on Card: </b>{{$order->billing_name_on_card}}<br/>
        <b>Billing Total: </b>{{$order->billing_total}}<br/>
        <b>Ordered on: </b>{{$order->created_at}}<br/>
      </p>
        @if(count($order->ordered_products()->get()) > 0)
          @foreach($order->ordered_products()->get() as $ordered_product)
            <p>
              <b>Product Number:</b>{{$ordered_product->product_id}}<br/>
              <b>Product Name:</b>{{$ordered_product->product->name}}<br/>
              <b>Product price:</b>{{$ordered_product->product->current_price}}<br/>
              <b>Quantity:</b>{{$ordered_product->quantity}}<br/>
              <b>Total Cost: </b>${{$ordered_product->quantity * $ordered_product->product->current_price}}<br/>

            </p>
          @endforeach
        @endif
      @endforeach
    @else
      <p>You don't have any orders <a href="{{route('shop.product.list')}}">search now</a></p>
    @endif 
</div>