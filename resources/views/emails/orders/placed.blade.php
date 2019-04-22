<html>
  <head>
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

<h1>Receipt #{{ $order->id }} Order Received</h1>


 <h3> Thank you for choosing the {{ config('app.name') }}!</h3>
 <hr>

<table class="myTable">
  <tbody>
    <tr>
      <th>**Order Id:**</th>
      <td>{{ $order->id }}</td>
    </tr>
    <tr>
      <th>**Order Email:**</th>
      <td>{{ $order->billing_email }}</td>
    </tr>
    <tr>
      <th>**Order Name:** </th>
      <td>{{ $order->billing_name }}</td>
    </tr>
    <tr>
      <th>**Order Total:**</th>
      <td>${{ round($order->billing_total, 2) }}</td>
    </tr>
  </tbody>
</table>

<br><br>
<h3>**Items Ordered**<h3>
<hr>
    <table class="myTable">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Product Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
    @foreach($order->products as $product)
        <tr>
            <td>{{$product->name}}</td>
            <td>{{$product->pivot->quantity}}</td>
            <td>${{$product->current_price}}</td>
            <td>${{$product->pivot->quantity * $product->current_price}}</td>
        </tr>
    @endforeach
        <tr>
          <td colspan="5" style="text-align:right;"><b>Total Price:</b> ${{$order->billing_total}}</td>
        </tr>
      </tbody>
    </table>
    <p>You can get further details about your order by logging into our website.</p>
    <a role="button" class="btn btn-primary" href="{{config('app.url')}}/dashboard">Go to Website</a>
    <p>Thank you again for choosing us.</p><br>
    <p>Regards,<br></p>
    {{ config('app.name') }}

  </body>
</head>
