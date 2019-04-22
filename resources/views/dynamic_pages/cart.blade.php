@extends('layouts.app')

@section('content')

  <h2>Shopping Cart</h2>

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
                <td>{{$product['item']->name}}</td>
                <td>
                    <form action="{{route('cart.updateQty')}}" method="POST">
                    <input type="number" class="input-text qty" step="1" min="1" max="" name="qty" value="{{$product['qty']}}" size="2" pattern="[0-9]*" inputmode="numeric">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$product['item']->id}}">
                    <input type="hidden" name="_method" value="PATCH">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></button>
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

        <a class="btn btn-primary" href="{{URL::previous()}}">continue shopping</a>
        
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

@endsection