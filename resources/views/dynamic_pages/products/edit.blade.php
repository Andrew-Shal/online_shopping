@extends('layouts.app')

@section('content')


<div class="page-wrapper chiller-theme toggled">
  @include('components.sidebar')
  
  <main class="page-content {{request()->segment(2)}} {{request()->segment(3)}} {{request()->segment(5)}}">
      @include('dynamic_pages.seller.components.navbar')
      <div class="container-fluid">
        <h2><span><i class="fa fa-truck pr-3"></span></i>{{$product->name}}</h2>
        <hr>
        <!--   -->
        <div class="row">
          <div class="col-md-10 pl-5">
            {!! Form::open(['action' => ['ProductController@update',$product->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            @csrf
              <div class="form-group">
                {{Form::label('name', 'Product Name')}}
                {{Form::text('name', $product->name, ['class' => $errors->has("name") ? "form-control is-invalid" : "form-control", 'placeholder'=>'product name', 'value'=> old("name") ])}}
                @if ($errors->has('name'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('name') }}</strong>
                  </span>
                @endif
              </div>
              <div class="form-group">
                  {{Form::label('current_price', 'Price')}}
                  {{Form::text('current_price', $product->current_price, ['class' => 'form-control', 'placeholder'=>'product price'])}}
                </div>
                <div class="form-group">
                  {{Form::label('qty', 'Quantity')}}
                  {{Form::text('qty', $product->qty, ['class' => 'form-control', 'placeholder'=>'Quantity'])}}
                </div>
                <div class="form-group">
                  {{Form::label('description', 'Product Description')}}
                  {{Form::textarea('description', $product->description, ['id'=>'description-ckeditor','class' => 'form-control', 'placeholder'=>'product description'])}}
                </div>
                <div class="form-group">
                  {{Form::label('condition', 'Product condition')}}
                  {{Form::textarea('condition', $product->condition, ['id'=>'condition-ckeditor','class' => 'form-control', 'placeholder'=>'product condition'])}}
                </div>
                <div class="form-group">
                  {{Form::label('return_policy', 'Return Policy')}}
                  {{Form::textarea('return_policy', $product->return_policy, ['id'=>'return-policy-ckeditor','class' => 'form-control', 'placeholder'=>'Return Policy'])}}
                </div>
                <div class="form-group">
                  {{Form::label('', 'Add a Featured Photo')}}
                  {{Form::file('featured_photo')}}
                </div>
                <div class="input-group control-group increment" >
                  <input type="file" name="filename[]" class="form-control">
                  <div class="input-group-btn"> 
                    <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                  </div>
                </div>
                <div class="clone hide">
                  <div class="control-group input-group" style="margin-top:10px">
                    <input type="file" name="filename[]" class="form-control">
                    <div class="input-group-btn"> 
                      <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                    </div>
                  </div>
                </div>
                {{Form::hidden('_method','PUT')}}
                {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
              {!! Form::close() !!}
            </div>
        </div>
      </div>
  
    </main>
    <!-- page-content" -->
  </div>  
@endsection

@section('scripts')
<script>
$(document).ready(function() {

  $(".btn-success").click(function(){ 
      var html = $(".clone").html();
      $(".increment").after(html);
  });

  $("body").on("click",".btn-danger",function(){ 
      $(this).parents(".control-group").remove();
  });

});
</script>


<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('description-ckeditor');
    CKEDITOR.replace('condition-ckeditor');
    CKEDITOR.replace('return-policy-ckeditor');
</script>

@endsection