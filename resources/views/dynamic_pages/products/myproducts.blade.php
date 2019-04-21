@extends('layouts.app')

@section('content')


<div class="page-wrapper chiller-theme toggled">
  @include('components.sidebar')
  
  <main class="page-content {{request()->segment(2)}}">
      @include('dynamic_pages.seller.components.navbar')
      
      <div id="breadcrumb"> <a href="{{route('seller_home')}}" title="Go to Home"><i class="fa fa-home"></i> Home</a> <a href="{{route('product.index')}}" class="current">Products</a></div>

      <div class="container-fluid">
        <h2><span><i class="fa fa-truck pr-3"></i></span>My Products</h2>
        <hr>
        
        @include('inc.messages')


        <div class="row">
            @if(count($products) > 0)
              @foreach($products as $product)
                <div class="card mr-4" style="width: 18rem;">

                    @if($product->featured_photo == 'noimage_placeholder.jpg')
                      <a href="/admin/dashboard/product/{{$product->id}}/{{$product->name}}"><img class="card-img-top" src="/storage/users/default/product_images/{{$product->featured_photo}}" alt="Card image cap"></a>
                    @else
                      <a href="/admin/dashboard/product/{{$product->id}}/{{$product->name}}"><img class="card-img-top" src="/storage/users/{{$product->user_id}}/product_images/{{$product->featured_photo}}" alt="Card image cap"></a>
                    @endif

                    <div class="card-body">
                      <h4>${{$product->current_price}}</h4>
                      <h5 class="card-title">{{$product->name}}</h5>
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
                        @endif
                        
                        <a href="/admin/dashboard/product/{{$product->id}}/edit" class="btn btn-primary">Edit</a>
                        {!! Form::open(['action' => ['ProductController@destroy', $product->id],'method' => 'POST', 'class' => 'float-right']) !!}
                          @csrf
                          {!! Form::hidden('_method', 'DELETE') !!}
                          {!! Form::submit('delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}  
                      
                    </div>
                  </div>
                @endforeach
              {{$products->links()}}
            @else
            <p>You haven't added any Products</p>
            @endif
        </div>
      </div>
  
  </main>
    <!-- page-content" -->
</div>  
@endsection

@section('scripts')
<style>
img.card-img-top {
  max-height: 280px;
}
</style>
@endsection